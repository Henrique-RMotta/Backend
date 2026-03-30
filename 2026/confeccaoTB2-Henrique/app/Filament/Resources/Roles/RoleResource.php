<?php

namespace App\Filament\Resources\Roles;

use App\Filament\Resources\Roles\Pages\CreateRole;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\Roles\Pages\ListRoles;
use App\Filament\Resources\Roles\Pages\ViewRole;
use App\Filament\Resources\Roles\Schemas\RoleForm;
use App\Filament\Resources\Roles\Schemas\RoleInfolist;
use App\Filament\Resources\Roles\Tables\RolesTable;
// use App\Models\Role;
use Spatie\Permission\Models\Role;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Columns\TextColumn;
use Ramsey\Collection\Set;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Cargos e Funções';

    // public static function canAccess(): bool
    // {
    //     return auth()->user()?->hasRole('Admin') ?? false;
    // }

    public static function canAccess(): bool
    {
        return auth()->user()?->can('acessar_clientes') ?? false;
    }

    public static function getLabel(): string {
        return "Função";
    }

    public static function getPluralLabel(): string {
        return "Funções";
    }

    public static function form(Schema $schema): Schema
    {
        // return RoleForm::configure($schema);
        return 
       
        $schema->components([
        TextInput::make('name')->label('Cargo')->required(),
        Select::make('permissions')
        ->label('Permissões de Acesso')
        ->multiple()
        ->relationship('permissions','name')
        ->preload()
        ->columnSpanFull(),
        TextInput::make('guard_name')->label('Sigla')->required(),
       
        ]);

    }

    public static function infolist(Schema $schema): Schema
    {
        return RoleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return RolesTable::configure($table);
        return $table 
        ->columns([
            TextColumn::make('permissions.name')->sortable()->searchable()->label('Permissões'),
            TextColumn::make('name')->sortable()->searchable()->label('Cargo'),
        ])->recordActions([
                ViewAction::make()->label('Visualizar'),
                EditAction::make()->label('Editar'),
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
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'view' => ViewRole::route('/{record}'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }


}
