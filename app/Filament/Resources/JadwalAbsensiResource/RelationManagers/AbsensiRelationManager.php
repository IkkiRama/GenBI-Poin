<?php

namespace App\Filament\Resources\JadwalAbsensiResource\RelationManagers;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AbsensiRelationManager extends RelationManager
{
    protected static string $relationship = 'absensi';

    public function form(Form $form): Form
    {
        return $form
            ->schema(//cek ketika user mempunyai role member maka hide option user_id
                Auth::user()->bidang !== "medeks" ? [
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'hadir' => 'Hadir',
                        'tidak hadir' => 'Tidak Hadir',
                    ])
                    ->searchable(),
                Forms\Components\FileUpload::make('image_bukti')
                    ->image()
                    ->required()
            ]:[
                Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'hadir' => 'Hadir',
                        'tidak hadir' => 'Tidak Hadir',
                    ])
                    ->searchable(),
                Forms\Components\FileUpload::make('image_bukti')
                    ->image()
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        $jumlahAbsensi = DB::table('absensis')->count();
        return $table
            ->recordTitleAttribute('status')
            ->columns([
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\IconColumn::make('is_true')
                    ->label("Validasi sekum")
                    ->boolean(),
                Tables\Columns\ImageColumn::make('image_bukti'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions( //cek ketika user mempunyai role member maka hanya boleh submit 1 kali dan ketika bukan role nya dewa
                // $jumlahAbsensi >= 1 && Auth::user()->hasRole('dewa') ? [] : [
                $jumlahAbsensi >= 1 ? [] : [
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
