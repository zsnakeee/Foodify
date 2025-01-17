<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers\ProductsRelationManager;
use App\Models\Category;
use App\Traits\HasLocalizedLabel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    use HasLocalizedLabel;

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-s-square-3-stack-3d';

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
                    Forms\Components\TextInput::make('name')
                        ->live(debounce: 500)
                        ->afterStateHydrated(function (Forms\Get $get, Forms\Set $set, $livewire) {
                            $set('slug', array_map(fn ($name) => slug($name), $get('name')));
                        })
                        ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set, ?string $state, $livewire) {
                            $set('slug', array_map(fn ($name) => slug($name), $get('name')));
                        })
                        ->required()
                        ->translatable(),
                    Forms\Components\TextInput::make('slug')
                        ->readOnly()
                        ->required()
                        ->translatable(),
                    Forms\Components\Textarea::make('description')
                        ->translatable(),
                ])->columnSpan(2),
                Forms\Components\Section::make([
                    Forms\Components\FileUpload::make('image')
                        ->image(),
                    Forms\Components\Toggle::make('is_active')
                        ->label(__('Active'))
                        ->required(),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('products_count')
                    ->counts('products')
                    ->sortable(),
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
            ->actions([
                Tables\Actions\EditAction::make(),
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
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
