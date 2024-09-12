<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackagePenilaianDeputiResource\Pages;
use App\Filament\Resources\PackagePenilaianDeputiResource\RelationManagers;
use App\Models\PackagePenilaianDeputi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackagePenilaianDeputiResource extends Resource
{
    protected static ?string $model = PackagePenilaianDeputi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('penilaian_deputi_id')
                    ->relationship('penilaian_deputi', 'id')
                    ->required(),
                Forms\Components\Select::make('penilaian_deputi_question_id')
                    ->relationship('penilaian_deputi_question', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penilaian_deputi.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('penilaian_deputi_question.id')
                    ->numeric()
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackagePenilaianDeputis::route('/'),
            'create' => Pages\CreatePackagePenilaianDeputi::route('/create'),
            'edit' => Pages\EditPackagePenilaianDeputi::route('/{record}/edit'),
        ];
    }
}
