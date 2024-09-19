<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
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
use Illuminate\Support\Facades\Storage;
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
        if (Auth::user()->hasRole("super_admin")) {
            return $form
                ->schema(
                    [
                    Select::make('user_id')
                        ->label('User')
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\TextInput::make('nama')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Tulis nama kegiatan. Misal "Mengikuti kepanitiaan Genius"👌'),
                    Forms\Components\DatePicker::make('tanggal')
                        ->required(),
                    Forms\Components\TextInput::make('link')
                        ->helperText('Masukan artikel yang anda publish'),
                    Select::make('jenis')
                        ->label('Jenis Kegiatan')
                        ->options([
                            'Responsibility' => 'Responsibility',
                            'Kontribusi' => 'Kontribusi',
                            'Event' => 'Event',
                            'Kreativitas' => 'Kreativitas',
                        ])
                        ->searchable(),
                    Forms\Components\TextInput::make('score')
                        ->numeric(),
                    Forms\Components\FileUpload::make('image_bukti')
                        ->image()
                        ->directory('foto_kegiatan')
                        ->required(),
                    Forms\Components\Textarea::make('resume')
                        ->helperText('Tulis Resuman Singkat Kegiatan Webinar Yang Diikuti'),
                ]
            );
        }elseif (Auth::user()->hasRole("deputi")) {
            return $form
                ->schema([
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
                ]);
        }else{
            return $form
                ->schema(
                    [
                    Forms\Components\Hidden::make('user_id')
                        ->default(Auth::user()->id),
                    Forms\Components\TextInput::make('nama')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Tulis nama kegiatan. Misal "Mengikuti kepanitiaan Genius"👌'),
                    Forms\Components\DatePicker::make('tanggal')
                        ->required(),
                    Forms\Components\FileUpload::make('image_bukti')
                        ->image()
                        ->directory('foto_kegiatan')
                        ->required(),
                    Forms\Components\TextInput::make('link')
                        ->helperText('Masukan artikel yang anda publish'),
                        Forms\Components\Textarea::make('resume')
                        ->helperText('Tulis Resuman Singkat Kegiatan Webinar Yang Diikuti')
                        ->columnSpanFull(),
                ]
            );
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $is_member = Auth::user()->hasRole('member');
                $is_deputi = Auth::user()->hasRole('deputi');

                if ($is_deputi) {
                    $query
                    ->whereHas('user', function($query) {
                        $query->where('komsat', '=', Auth::user()->komsat);
                    })
                    ->whereHas('user', function($query) {
                        $query->where('bidang', '=', Auth::user()->bidang);
                    });
                }elseif ($is_member) {
                    $query->where('user_id', Auth::user()->id);
                }
            })
            ->columns(Auth::user()->hasRole("super_admin") || Auth::user()->hasRole("bph") ?
            [
                TextColumn::make('nomer')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label("Nama User")
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label("Nama Kegiatan")
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->badge()
                    ->label("Jenis Kegiatan")
                    ->searchable(),
                Tables\Columns\TextColumn::make('score')
                    ->label("Poin Kegiatan")
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_bukti')
                    ->label("Foto Bukti"),
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
                TextColumn::make('nomer')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->badge()
                    ->label("Jenis Kegiatan")
                    ->searchable(),
                Tables\Columns\TextColumn::make('score')
                    ->label("Poin Kegiatan")
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_bukti')
                    ->label("Foto Bukti"),
            ]
            )
            ->filters(Auth::user()->hasRole("super_admin") ? [
                Tables\Filters\TrashedFilter::make(),
            ]:[])
            ->actions(Auth::user()->bidang === "medeks" ? [] : [
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

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKegiatans::route('/'),
        ];
    }
}
