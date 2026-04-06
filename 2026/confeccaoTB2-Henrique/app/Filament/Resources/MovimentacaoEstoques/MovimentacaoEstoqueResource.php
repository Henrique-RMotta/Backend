<?php

namespace App\Filament\Resources\MovimentacaoEstoques;

use App\Filament\Resources\MovimentacaoEstoques\Pages\CreateMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Pages\EditMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Pages\ListMovimentacaoEstoques;
use App\Filament\Resources\MovimentacaoEstoques\Pages\ViewMovimentacaoEstoque;
use App\Filament\Resources\MovimentacaoEstoques\Schemas\MovimentacaoEstoqueForm;
use App\Filament\Resources\MovimentacaoEstoques\Schemas\MovimentacaoEstoqueInfolist;
use App\Filament\Resources\MovimentacaoEstoques\Tables\MovimentacaoEstoquesTable;
use App\Models\MovimentacaoEstoque;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use \Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use UnitEnum;

class MovimentacaoEstoqueResource extends Resource
{
    protected static ?string $model = MovimentacaoEstoque::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Movimentação Estoque';

    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    protected static ?int $navigationSort = 3 ;

    public static function form(Schema $schema): Schema
    {
        // return MovimentacaoEstoqueForm::configure($schema);
        return $schema
            ->components([
                Select::make('produto_id')
                ->relationship('produto','nome')
                ->required()
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Selecione o Produto'),

                Select::make('status')
                ->options([
                    'entrada' => 'Entrada',
                    'saida' => 'Saída',
                ])
                    ->default('entrada')
                    ->label('Selecione o Status')
                    ->required(),

                TextInput::make('quantidade')
                    ->required()
                    ->numeric()
                    ->label('Quantidade'),
                
                TextInput::make('estoque')
                    ->numeric()
                    ->label('Estoque'),
                
                TextInput::make('observacao')
                    ->label("Observação"),
                
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MovimentacaoEstoqueInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // return MovimentacaoEstoquesTable::configure($table);
        return $table 
            ->columns([
                TextColumn::make('produto.nome')
                    ->label('Produto')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('quantidade')
                    ->label('Quantidade')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('observacao')
                    ->label('Observação'),
                
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match($state){
                        'saida' => 'warning',
                        'entrada' => 'sucess',
                        default => 'warning',
                    }),

                TextColumn::make('estoque')
                    ->label('Estoque Total')
                    ->sortable(),



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
            'index' => ListMovimentacaoEstoques::route('/'),
            'create' => CreateMovimentacaoEstoque::route('/create'),
            'view' => ViewMovimentacaoEstoque::route('/{record}'),
            'edit' => EditMovimentacaoEstoque::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
