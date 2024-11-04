<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use App\Models\PenilaianDeputiQuestion;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenilaianDeputiQuestionResource\Pages;
use App\Filament\Resources\PenilaianDeputiQuestionResource\RelationManagers;

class PenilaianDeputiQuestionResource extends Resource
{
    protected static ?string $model = PenilaianDeputiQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Penilaian Deputi';

    protected static ?string $navigationLabel = 'List Pertanyaan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Repeater::make('members')
                ->relationship("penilaian_deputi_option")
                ->label("List Jawaban")
                ->schema([
                TextInput::make("option_text")
                    ->label("Jawaban")
                    ->required(),
                TextInput::make("score")
                    ->helperText('Isi score untuk jawaban. Misal 5/4/3/2/1')
                    ->required()
                ])
                ->columns(1)
                ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(Auth::user()->getRoleNames()[0] !== "super_admin" ? [
                Tables\Columns\TextColumn::make('question')
                    ->searchable(),
            ] : [
                Tables\Columns\TextColumn::make('question')
                    ->searchable(),
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
            ->filters(Auth::user()->hasRole("super_admin") ? [
                Tables\Filters\TrashedFilter::make(),
            ]:[])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenilaianDeputiQuestions::route('/'),
        ];
    }
}
