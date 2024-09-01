<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kegiatan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Count;
use App\Filament\Resources\KegiatanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KegiatanResource\RelationManagers;
use App\Filament\Resources\KegiatanResource\RelationManagers\PoinKegiatanRelationManager;

class KegiatanResource extends Resource
{
    protected static ?string $model = Kegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-s-squares-2x2';

    protected static ?string $navigationLabel = 'Kegiatan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Auth::user()->bidang === "medeks" ?
                [
                    Forms\Components\TextInput::make('nama')
                        ->readOnly(),
                    Forms\Components\DatePicker::make('tanggal')
                        ->readOnly(),
                    Forms\Components\FileUpload::make('image_bukti')
                        ->deletable(false)
                        ->openable(),
                    Forms\Components\TextInput::make('link')
                        ->readOnly()
                        ->helperText('Masukan artikel yang anda publish'),
                    Forms\Components\Textarea::make('resume')
                        ->readOnly()
                        ->helperText('Tulis Resuman Singkat Kegiatan Webinar Yang Diikuti')
                        ->columnSpanFull(),
                ] :
                [
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\FileUpload::make('image_bukti')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('link')
                    ->helperText('Masukan artikel yang anda publish'),
                    Forms\Components\Textarea::make('resume')
                    ->helperText('Tulis Resuman Singkat Kegiatan Webinar Yang Diikuti')
                    ->columnSpanFull(),
            ]
        );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomer')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image_bukti')
                    ->label("Foto Bukti"),
                    Tables\Columns\TextColumn::make('poin_kegiatan.score')
                    ->label("Poin Kegiatan")
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
            ->filters([
                //
            ])
            ->actions(Auth::user()->bidang === "medeks" ? [] : [
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
            PoinKegiatanRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKegiatans::route('/'),
            'edit' => Pages\EditKegiatan::route('/{record}/edit'),
        ];
    }
}
