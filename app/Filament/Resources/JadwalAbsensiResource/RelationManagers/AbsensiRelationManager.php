<?php

namespace App\Filament\Resources\JadwalAbsensiResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\JadwalAbsensi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AbsensiRelationManager extends RelationManager
{
    protected static string $relationship = 'absensi';

    public function form(Form $form): Form
    {
        if (Auth::user()->hasRole("super_admin")) {
            return $form
            ->schema(//cek ketika user mempunyai role member maka hide option user_id
            [
                Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Absen' => 'Absen',
                    ])
                    ->searchable(),
                Toggle::make("is_true")
                    ->label("Validasi Sekum"),
                Forms\Components\FileUpload::make('image_bukti')
                    ->image()
                    ->required()
                    ->directory("foto_absensi")
                    ->columnSpanFull(),
            ]);
        }elseif (Auth::user()->hasRole("bph")) {
            return $form
            ->schema(
            [
                Select::make('user_id')
                    ->label('User')
                    ->disabledOn('edit')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Tidak Hadir' => 'Tidak Hadir',
                    ])
                    ->searchable(),
                Toggle::make("is_true")
                    ->label("Validasi Sekum"),
                Forms\Components\FileUpload::make('image_bukti')
                    ->deletable(false)
                    ->openable()
                    ->columnSpanFull(),
            ]);
        }else{
            return $form
            ->schema(
            [
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Tidak Hadir' => 'Tidak Hadir',
                    ])
                    ->searchable(),
                Forms\Components\FileUpload::make('image_bukti')
                    ->image()
                    ->required()
            ]);
        }

    }

    public function table(Table $table): Table
    {
        $data = $this->ownerRecord;
        $jumlahAbsensi = DB::table('absensis')
                        ->where('user_id', Auth::user()->id)
                        ->where("jadwal_absensi_id", $data->id)
                        ->count();
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $is_deputi = Auth::user()->hasRole('deputi');
                $is_member = Auth::user()->hasRole('member');

                if ($is_deputi || $is_member) {
                    $query->where('user_id', Auth::user()->id);
                }
            })
            ->recordTitleAttribute('status')
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\IconColumn::make('is_true')
                    ->label("Validasi sekum")
                    ->boolean(),
                Tables\Columns\ImageColumn::make('image_bukti'),
            ])
            ->filters(Auth::user()->hasRole("super_admin") ? [
                Tables\Filters\TrashedFilter::make(),
            ]:[])
            ->headerActions(
                //cek ketika user mempunyai role member maka hanya boleh submit 1 kali dan ketika bukan role nya dewa
                // $jumlahAbsensi >= 1 && Auth::user()->hasRole('dewa') ? [] : [
                $jumlahAbsensi >= 1  ? [] : [
                Tables\Actions\CreateAction::make()
                ->disableCreateAnother()
                ->visible(function () {
                    // $jadwal = $this->getOwnerRecord();
                    // Cek apakah user memiliki role super_admin
                    if (Auth::user()->hasRole('super_admin') || Auth::user()->hasRole('bph')) {
                        return true; // super_admin bebas memasukkan data kapanpun
                    }

                    // Mendapatkan jadwal absensi yang sedang ditampilkan
                    $jadwal = $this->ownerRecord; // Menggunakan $this->ownerRecord untuk mengambil data dari relasi
                    $now = Carbon::now('Asia/Jakarta');

                    $startTime = Carbon::parse($jadwal->start_time, 'Asia/Jakarta');
                    $endTime = Carbon::parse($jadwal->end_time, 'Asia/Jakarta');

                    // Memeriksa apakah waktu sekarang berada di antara start_time dan end_time
                    return $now->between($startTime, $endTime);
                }),
            ])
            ->actions(Auth::user()->hasRole("super_admin") || Auth::user()->hasRole("bph") ? [
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ] : [
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions(Auth::user()->hasRole("super_admin") || Auth::user()->hasRole("bph") ? [
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ]:[]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
