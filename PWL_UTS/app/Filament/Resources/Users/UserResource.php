<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use App\Models\UserModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\Users\Pages\ViewUser;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class UserResource extends Resource
{
    protected static ?string $model = UserModel::class;
    protected static ?string $navigationLabel = 'User';
    protected static ?string $modelLabel = 'User';
    protected static ?string $pluralModelLabel = 'User';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi User')
                    ->icon('heroicon-o-users')
                    ->schema([
                        TextEntry::make('user_id')
                            ->label('ID User')
                            ->icon('heroicon-o-key'),
                        TextEntry::make('nama')
                            ->label('Nama User')
                            ->size('lg')
                            ->weight('bold'),
                        TextEntry::make('email')
                            ->label('Email User')
                            ->badge()
                            ->color('success'),
                    ])
                    ->columns(1),
                Section::make('Informasi Tambahan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->icon('heroicon-o-calendar')
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui Pada')
                            ->icon('heroicon-o-rectangle-stack')
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->label('Dihapus Pada')
                            ->icon('heroicon-o-trash')
                            ->placeholder('-'),
                    ])->columns(1),
            ]);
    }

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
            'view' => ViewUser::route('/{record}'),
        ];
    }
}
