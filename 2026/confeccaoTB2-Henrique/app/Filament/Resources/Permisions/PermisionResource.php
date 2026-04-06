<?php

namespace App\Filament\Resources\Permisions;

use App\Filament\Resources\Permisions\Pages\CreatePermision;
use App\Filament\Resources\Permisions\Pages\EditPermision;
use App\Filament\Resources\Permisions\Pages\ListPermisions;
use App\Filament\Resources\Permisions\Pages\ViewPermision;
use App\Filament\Resources\Permisions\Schemas\PermisionForm;
use App\Filament\Resources\Permisions\Schemas\PermisionInfolist;
use App\Filament\Resources\Permisions\Tables\PermisionsTable;
// use App\Models\Permision;
use Spatie\Permission\Models\Permission;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class PermisionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Permissões';

    protected static string|UnitEnum|null $navigationGroup = 'Configurações';

    protected static ?int $navigationSort = 2 ;

    
    public static function getLabel(): string {
        return "Permissão";
    }

    public static function getPluralLabel(): string {
        return "Permissões";
    }

    public static function form(Schema $schema): Schema
    {
        // return PermisionForm::configure($schema);
        return $schema 
        ->components([
        TextInput::make('name')
        ->label('Nome da Regra')
        ->required(),

        TextInput::make('guard_name')
        ->label('Sigla da Regra'),
        ]
        );
        
    }

    public static function infolist(Schema $schema): Schema
    {
        return PermisionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return PermisionsTable::configure($table);
        return $table 
            ->columns([
                TextColumn::make('name')->label('Nome')->sortable()->searchable(),
                TextColumn::make('guard_name')->label('sigla')->sortable()->searchable(),
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
            'index' => ListPermisions::route('/'),
            'create' => CreatePermision::route('/create'),
            'view' => ViewPermision::route('/{record}'),
            'edit' => EditPermision::route('/{record}/edit'),
        ];
    }
}
