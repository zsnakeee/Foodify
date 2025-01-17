<?php

namespace App\Filament\Resources;

use App\Filament\Exports\ProductExporter;
use App\Filament\Imports\ProductImporter;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Traits\HasLocalizedLabel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    use HasLocalizedLabel;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-building-storefront';

    protected static ?string $navigationGroup = 'Shop';

    public static function getRecordRouteKeyName(): ?string
    {
        return 'slug->'.app()->getLocale();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('code')
                        ->required()
                        ->disabledOn('edit'),
                    Forms\Components\TextInput::make('name')
                        ->live(debounce: 500)
                        ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set, ?string $state, $livewire) {
                            $set('slug', array_map(fn ($name) => slug($name), $get('name')));
                        })
                        ->required()
                        ->translatable(),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->translatable(),

                    Forms\Components\Textarea::make('description')
                        ->label(__('Description'))
                        ->translatable(),

                    Forms\Components\Group::make([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required(),
                        Forms\Components\Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->required(),
                    ])->columns(2),
                ])->columnSpan(2),

                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->default(0)
                        ->prefix('$')
                        ->columnSpan(2),
                    Forms\Components\TextInput::make('quantity')
                        ->required()
                        ->numeric()
                        ->default(0),

                    Forms\Components\Section::make([
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('Active'))
                            ->required(),
                        Forms\Components\Toggle::make('is_new')
                            ->label(__('New'))
                            ->required(),
                        Forms\Components\Toggle::make('is_featured')
                            ->label(__('Featured'))
                            ->required(),
                        Forms\Components\Toggle::make('is_best')
                            ->label(__('Best'))
                            ->required(),
                        Forms\Components\Toggle::make('is_hot')
                            ->label(__('Hot'))
                            ->required(),
                    ])->columns(3),

                    Forms\Components\FileUpload::make('image')
                        ->label(__('Thumbnail'))
                        ->columnSpanFull()
                        ->image(),

                    Forms\Components\FileUpload::make('gallery')
                        ->label(__('Gallery'))
                        ->columnSpanFull()
                        ->image()
                        ->multiple(),
                ])
                    ->columns(3)
                    ->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->formatStateUsing(fn ($state) => strtoupper($state))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('Thumbnail')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(['name', 'slug']),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_new')
                    ->label(__('New'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('Featured'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_best')
                    ->label(__('Best'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_hot')
                    ->label(__('Hot'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->importer(ProductImporter::class)
                    ->label(__('Import'))
                    ->color('primary'),
                Tables\Actions\ExportAction::make()
                    ->exporter(ProductExporter::class)
                    ->label(__('Export'))
                    ->icon('heroicon-s-arrow-down-tray')
                    ->color('primary'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ExportAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
