<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\UserRelationManager;
use App\Models\Customer;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Collection;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 1;

    // protected static ?string $recordTitleAttribute = 'user.name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('user.email')
                    ->label('Email')
                    ->email()
                    ->unique('users', 'email', ignoreRecord: true)
                    ->required(),
                    
                TextInput::make('user.name')
                    ->label('Nama')
                    ->required(),
                
                TextInput::make('no_telp')
                    ->label('Nomor Telepon')
                    ->maxLength(14)
                    ->required(),

                DateTimePicker::make('user.email_verified_at')
                    ->label('Email Verified At')
                    ->default(now()),

                TextInput::make('user.password')
                    ->label('Password')
                    ->password()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Nama')
                    ->searchable(),
                
                TextColumn::make('no_telp')
                    ->label("Nomor Telepon"),

                TextColumn::make('user.email_verified_at')
                ->label('Email Verified At')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('user.created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    // EditAction::make(),
                    ViewAction::make()
                        ->mutateRecordDataUsing(function (array $data, $record): array {
                        $user = $record->user;

                        $data['user']['email'] = $user->email;
                        $data['user']['name'] = $user->name;
                        $data['user']['email_verified_at'] = $user->email_verified_at;
                        $data['user']['password'] = '12345678';

                        return $data;
                    }),
                    DeleteAction::make()
                ])
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
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}