<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Kontak;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use App\Mail\ReplyToMessageMail;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KontakResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KontakResource\RelationManagers;

class KontakResource extends Resource
{
    protected static ?string $model = Kontak::class;

    protected static ?string $navigationIcon = 'heroicon-s-envelope';

    protected static ?string $navigationLabel = 'Kontak';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Auth::user()->hasRole('super_admin') ? [
                Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->columnSpanFull()
                    ->searchable(),
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->columnSpanFull()
                    ->helperText('Sampaikan pesan untuk para anggota genbi yang aktif. pesan bisa berupa salam, doa, harapan, dll.')
            ]:[
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id),
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->columnSpanFull()
                    ->helperText('Sampaikan pesan untuk para anggota genbi yang aktif. pesan bisa berupa salam, doa, harapan, dll.')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $is_super_admin = Auth::user()->hasRole('super_admin');

                if (!$is_super_admin) {
                    $query->where('user_id', Auth::user()->id);
                }
            })
            ->columns(Auth::user()->hasRole("super_admin") ? [
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('message'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ] : [
                Tables\Columns\TextColumn::make('message')
            ])
            ->filters(Auth::user()->hasRole("super_admin") ? [
                Tables\Filters\TrashedFilter::make(),
            ]:[])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('reply')
                    ->label('Replay')
                    ->icon('heroicon-s-paper-airplane')
                    ->action(function ($record) {
                        // Dapatkan pengguna yang mengirim pesan
                        $user = User::find($record->user_id);

                        // Kirim email balasan
                        Mail::to($user->email)->send(new ReplyToMessageMail($record));
                    })
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
            'index' => Pages\ListKontaks::route('/'),
        ];
    }
}
