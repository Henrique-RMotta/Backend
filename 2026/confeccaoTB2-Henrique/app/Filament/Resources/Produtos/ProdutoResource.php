<?php

namespace App\Filament\Resources\Produtos;

use App\Filament\Resources\Produtos\Pages\CreateProduto;
use App\Filament\Resources\Produtos\Pages\EditProduto;
use App\Filament\Resources\Produtos\Pages\ListProdutos;
use App\Filament\Resources\Produtos\Pages\ViewProduto;
use App\Filament\Resources\Produtos\Schemas\ProdutoForm;
use App\Filament\Resources\Produtos\Schemas\ProdutoInfolist;
use App\Filament\Resources\Produtos\Tables\ProdutosTable;
use App\Models\Produto;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use BackedEnum;
class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nome';

    public static function form(Schema $schema): Schema
    {
        return $schema 
            ->components([
                TextInput::make('nome')->required()->label("Nome do Produto"),
                TextInput::make("referencia")->label("Referencia"),
                TextInput::make('preco_venda')->numeric()->prefix("R$")->required(),
                TextInput::make('estoque')->numeric()->default(0)->required()->label('Estoque'),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProdutoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table 
            ->columns([
                TextColumn::make('nome')->searchable(),
                TextColumn::make("referencia"),
                TextColumn::make('preco_venda')->money('BRL'),
                TextColumn::make('estoque'),
            ])
            ->recordActions([
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
            'index' => ListProdutos::route('/'),
            'create' => CreateProduto::route('/create'),
            'view' => ViewProduto::route('/{record}'),
            'edit' => EditProduto::route('/{record}/edit'),
        ];
    }
}
