<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PenilaianDeputi;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use App\Filament\Resources\PenilaianDeputiResource\Pages;
use App\Filament\Resources\PenilaianDeputiResource\RelationManagers\PenilaianDeputiAnswerRelationManager;

class PenilaianDeputiResource extends Resource
{
    protected static ?string $model = PenilaianDeputi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Penilaian Deputi';

    protected static ?string $navigationLabel = 'Penilaian';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('start_time')
                    ->required()
                    ->label("Waktu Mulai"),
                    Forms\Components\DateTimePicker::make('end_time')
                    ->required()
                    ->label("Waktu Selesai"),
                Repeater::make('members')
                    ->relationship("package_penilaian_deputi")
                    ->label("List Pertanyaan")
                    ->schema([
                        Select::make('penilaian_deputi_question_id')
                            ->relationship("penilaian_deputi_question", "question")
                            ->label("Pertanyaan")
                            ->required()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                    ])
                ->columns(1)
                ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(Auth::user()->getRoleNames()[0] !== "super_admin" ? [
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->dateTime()
                    ->sortable(),
            ]:[
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('start_time', 'asc')  // Mengatur pengurutan default berdasarkan start_time
            ->defaultSort('end_time', 'asc')
            ->filters(Auth::user()->hasRole("super_admin") ? [
                Tables\Filters\TrashedFilter::make(),
            ]:[])
            ->actions(Auth::user()->hasRole("member") ? [
                Action::make("nilai")
                    ->label(function (PenilaianDeputi $record) {
                        $now = Carbon::now('Asia/Jakarta');
                        $startTime = Carbon::parse($record->start_time, 'Asia/Jakarta');
                        $endTime = Carbon::parse($record->end_time, 'Asia/Jakarta');

                        // Jika waktu sekarang berada di antara start_time dan end_time, ubah label menjadi "Lihat Penilaian"
                        if ($now->between($startTime, $endTime)) {
                            return 'Nilai Sekarang';
                        }

                        return 'Lihat Penilaian';
                    })
                    ->url(fn (PenilaianDeputi $record): string => route("NilaiDeputi", $record))
                    ->color(function (PenilaianDeputi $record) {
                        $now = Carbon::now('Asia/Jakarta');
                        $startTime = Carbon::parse($record->start_time, 'Asia/Jakarta');
                        $endTime = Carbon::parse($record->end_time, 'Asia/Jakarta');

                        // Jika waktu sekarang berada di antara start_time dan end_time, ubah warna menjadi success
                        if ($now->between($startTime, $endTime)) {
                            return 'info';
                        }

                        return 'success';
                    })
                    ->icon("heroicon-s-paper-airplane")
                    ->visible(function (PenilaianDeputi $record) {
                        $now = Carbon::now('Asia/Jakarta');
                        $startTime = Carbon::parse($record->start_time, 'Asia/Jakarta');

                        // Hanya tampilkan tombol jika waktu sekarang lebih besar atau sama dengan start_time
                        return $now->greaterThanOrEqualTo($startTime);
                    }),
            ]: [
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenilaianDeputis::route('/'),
            'edit' => Pages\EditPenilaianDeputi::route('/{record}/edit'),
        ];
    }
}
