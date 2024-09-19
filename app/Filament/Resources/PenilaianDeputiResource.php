<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PenilaianDeputi;
use Filament\Resources\Resource;
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
            ->columns([
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
            ->filters([
                //
            ])
            ->actions([
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
            PenilaianDeputiAnswerRelationManager::class
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
