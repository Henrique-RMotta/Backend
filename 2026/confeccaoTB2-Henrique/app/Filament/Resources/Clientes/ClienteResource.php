<?php

namespace App\Filament\Resources\Clientes;

use App\Filament\Resources\Clientes\Pages\CreateCliente;
use App\Filament\Resources\Clientes\Pages\EditCliente;
use App\Filament\Resources\Clientes\Pages\ListClientes;
use App\Filament\Resources\Clientes\Pages\ViewCliente;
use App\Filament\Resources\Clientes\Schemas\ClienteForm;
use App\Filament\Resources\Clientes\Schemas\ClienteInfolist;
use App\Filament\Resources\Clientes\Tables\ClientesTable;
use App\Models\Cliente;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\RawJs;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use UnitEnum;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static string|UnitEnum|null $navigationGroup = 'Cadstros Gerais';

    protected static ?int $navigationSort = 1 ;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Cliente';

    public static function form(Schema $schema): Schema
    {
        return $schema 
        ->components([
            textInput::make('nome')->required()->label('Nome Completo'),
            textInput::make('email')->required()->email()->label('Email'),
            textInput::make('telefone')->tel()->label('telefone')->mask('(99) 99999-9999'),
            textInput::make('documento')->label('CPF ou CNPJ')->mask(RawJs::make(<<<'JS'
                    $input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99' 
                JS)),
        ]);
        // return ClienteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ClienteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return ClientesTable::configure($table);
        return $table
            ->columns([
                textColumn::make('nome')->label('Nome Completo')->searchable()->sortable(),
                textColumn::make('email')->label('Email')->searchable()->sortable(),
                textColumn::make('telefone')->label('Telefone')->searchable()->sortable(),
                textColumn::make('documento')->label('CPF ou CNPJ')->searchable()->sortable(),
             
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
            'index' => ListClientes::route('/'),
            'create' => CreateCliente::route('/create'),
            'view' => ViewCliente::route('/{record}'),
            'edit' => EditCliente::route('/{record}/edit'),
        ];
    }
}
