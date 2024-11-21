<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CashierResource\Pages;
use App\Filament\Resources\CashierResource\RelationManagers;
use App\Models\Cashier;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
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

class CashierResource extends Resource
{
    protected static ?string $model = Cashier::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

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
                    ->label('Nama'),
                
                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Pria' => 'Pria',
                        'Wanita' => 'Wanita'
                    ])
                    ->required(),

				TextInput::make('no_telp')
					->label('Nomor Telpon')
					->required(),

				DateTimePicker::make('user.email_verified_at')
					->readOnly()
					->default(now()),
				
				TextInput::make('user.password')
					->label('Password')
					->password()
					->dehydrated(fn($state) => filled($state))
					->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord),
				
				Textarea::make('address')
					->label("Alamat")
					->rows(4)
					->required()
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
                    ->label('name')
                    ->searchable(),

                TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->searchable(),

                TextColumn::make('no_telp')
                    ->label('Nomor Telpon')
                    ->searchable(),

                TextColumn::make('address')
                    ->label('Alamat')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
					EditAction::make(),
					ViewAction::make()
                        ->mutateRecordDataUsing(function (array $data, $record): array {
                        $user = $record->user;

                        $data['user']['email'] = $user->email;
                        $data['user']['name'] = $user->name;
                        $data['user']['email_verified_at'] = $user->email_verified_at;
                        $data['user']['password'] = $user->password;

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
            'index' => Pages\ListCashiers::route('/'),
            'create' => Pages\CreateCashier::route('/create'),
            'edit' => Pages\EditCashier::route('/{record}/edit'),
        ];
    }
}
