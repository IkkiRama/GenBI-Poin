<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\JadwalAbsensi;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JadwalAbsensiResource\Pages;
use App\Filament\Resources\JadwalAbsensiResource\RelationManagers;
use App\Filament\Resources\JadwalAbsensiResource\RelationManagers\AbsensiRelationManager;
use Filament\Tables\Actions\CreateAction;

class JadwalAbsensiResource extends Resource
{
    protected static ?string $model = JadwalAbsensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Absensi';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
            Auth::user()->hasRole("super_admin") || Auth::user()->hasRole("bph") ? [
                Forms\Components\TextInput::make('nama_kegiatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jumlah_poin')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('start_time')
                    ->label("Mulai")
                    ->seconds(false)
                    ->beforeOrEqual('end_time'),
                DateTimePicker::make('end_time')
                    ->label("Deadline")
                    ->seconds(false)
                    ->afterOrEqual('start_time')
            ] : [
                Forms\Components\TextInput::make('nama_kegiatan')
                    ->readOnly(),
                Forms\Components\TextInput::make('jumlah_poin')
                    ->readOnly(),
                Forms\Components\TextInput::make('start_time')
                    ->readOnly(),
                Forms\Components\TextInput::make('end_time')
                    ->readOnly(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(Auth::user()->hasRole("super_admin") ? [
                Tables\Columns\TextColumn::make('nama_kegiatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_poin')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label("Mulai")
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label("Deadline")
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
            ] : [
                Tables\Columns\TextColumn::make('nama_kegiatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_poin')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label("Mulai")
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label("Deadline")
                    ->sortable(),
            ])
            ->defaultSort('start_time', 'desc')  // Mengatur pengurutan default berdasarkan start_time
            ->defaultSort('end_time', 'desc')
            ->filters(Auth::user()->hasRole("super_admin") ? [
                Tables\Filters\TrashedFilter::make(),
            ]:[])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label("Detail")
                    ->icon("heroicon-s-information-circle")
                    ->color("info"),
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

    public static function getRelations(): array
    {
        return [
            AbsensiRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalAbsensis::route('/'),
            'edit' => Pages\EditJadwalAbsensi::route('/{record}/edit'),
        ];
    }
}
