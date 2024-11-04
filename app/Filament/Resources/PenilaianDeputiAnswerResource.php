<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use App\Models\PenilaianDeputiAnswer;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PenilaianDeputiAnswersOption;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PenilaianDeputiAnswerResource\Pages;
use App\Filament\Resources\PenilaianDeputiAnswerResource\RelationManagers;

class PenilaianDeputiAnswerResource extends Resource
{
    protected static ?string $model = PenilaianDeputiAnswer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Penilaian Deputi';

    protected static ?string $navigationLabel = 'Jawaban Penilaian';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('deputi_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('penilaian_deputi_id')
                    ->relationship('penilaian_deputi', 'id')
                    ->required(),
                Forms\Components\Toggle::make('is_submited'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(Auth::user()->hasRole("super_admin") ? [
                Tables\Columns\TextColumn::make('penilaian_deputi.judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label("Nama")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deputi.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_score')
                    ->label('Total Score')
                    ->getStateUsing(function (PenilaianDeputiAnswer $record) {
                        return PenilaianDeputiAnswersOption::where('pd_answer_id', $record->id)->sum('score');
                    }),
                Tables\Columns\IconColumn::make('is_submited')
                    ->boolean(),
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
            ] : [
                Tables\Columns\TextColumn::make('penilaian_deputi.judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label("Nama")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deputi.name')
                    ->searchable()
                    ->sortable(),
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

    public function getTotalScore(int $answerId): int{
        return PenilaianDeputiAnswersOption::where('pd_answer_id', $answerId)
            ->sum('score');
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenilaianDeputiAnswers::route('/'),
        ];
    }
}
