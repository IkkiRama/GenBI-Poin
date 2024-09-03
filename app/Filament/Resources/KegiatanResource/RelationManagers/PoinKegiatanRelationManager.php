<?php

namespace App\Filament\Resources\KegiatanResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PoinKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class PoinKegiatanRelationManager extends RelationManager
{
    protected static string $relationship = 'poin_kegiatan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('jenis')
                    ->options([
                        'Responsibility' => 'Responsibility',
                        'Kontribusi' => 'Kontribusi',
                        'Kontribusi' => 'Kontribusi',
                        'Event' => 'Event',
                        'Kreativitas' => 'Kreativitas',
                    ]),
                Forms\Components\TextInput::make('score')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        $poinKegiatan = DB::table('poin_kegiatans')->count();

        return $table
            ->recordTitleAttribute('jenis')
            ->columns([
                Tables\Columns\TextColumn::make('jenis'),
                Tables\Columns\TextColumn::make('score'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->headerActions( $poinKegiatan > 0 || Auth::user()->bidang === "medeks" ? [] : [
                Tables\Actions\CreateAction::make(),
            ])
            ->actions(Auth::user()->bidang === "medeks" ? [] : [
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions(Auth::user()->bidang === "medeks" ? [] : [
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
