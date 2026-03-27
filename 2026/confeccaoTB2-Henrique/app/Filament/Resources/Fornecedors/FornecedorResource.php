<?php

namespace App\Filament\Resources\Fornecedors;

use App\Filament\Resources\Fornecedors\Pages\CreateFornecedor;
use App\Filament\Resources\Fornecedors\Pages\EditFornecedor;
use App\Filament\Resources\Fornecedors\Pages\ListFornecedors;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorForm;
use App\Filament\Resources\Fornecedors\Tables\FornecedorsTable;
use App\Models\Fornecedor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\CheckboxList;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Support\RawJs;
class FornecedorResource extends Resource
{
    protected static ?string $model = Fornecedor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Fornecedor';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                textInput::make("FR_nome")->required()->label('Nome Completo'),
                textInput::make("FR_email")->required()->email()->label('Email'),
                textInput::make('FR_telefone')->tel()->label('Telefone')->mask('(99) 99999-9999'),
                textInput::make("FR_CNPJ")->label('CPF ou CNPJ')->mask(RawJs::make(<<<'JS'
                    $input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99' 
                JS)),
                CheckboxList::make('FR_tipo')->label('Tipo de Fornecedor')
                    ->options([
                        'alimentacao' => 'Alimentação',
                        'producao' => 'Produção',
                        'manutencao' => 'Manutenção',
                        'predial' => 'Predial',
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                textColumn::make('FR_nome')->label('Nome do Fornecedor')->searchable()->sortable(),
                textColumn::make('FR_email')->label('Email do Fornecedor')->searchable()->sortable(),
                textColumn::make('FR_telefone')->label('Telefone do Fornecedor')->searchable()->sortable(),
                textColumn::make('FR_CNPJ')->label('CNPJ do Fornecedor')->searchable()->sortable(),
                textColumn::make('FR_tipo')->label('Tipo de fornecedor')->searchable()->sortable(),

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
            'index' => ListFornecedors::route('/'),
            'create' => CreateFornecedor::route('/create'),
            'edit' => EditFornecedor::route('/{record}/edit'),
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
