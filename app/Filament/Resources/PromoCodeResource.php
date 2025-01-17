<?php

namespace App\Filament\Resources;

use App\Enums\DiscountType;
use App\Filament\Resources\PromoCodeResource\Pages;
use App\Models\PromoCode;
use App\Traits\HasLocalizedLabel;
use Filament\Forms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Str;

class PromoCodeResource extends Resource
{
    use HasLocalizedLabel;

    protected static ?string $model = PromoCode::class;

    protected static ?string $navigationIcon = 'heroicon-s-percent-badge';

    protected static ?string $navigationGroup = 'Shop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->default(fn () => Str::random(8))
                    ->unique()
                    ->disabledOn('edit')
                    ->suffixAction(function (HasForms $livewire) {
                        if ($livewire instanceof Pages\EditPromoCode) {
                            return null;
                        }

                        return Forms\Components\Actions\Action::make('Generate')
                            ->icon('heroicon-s-arrow-path')
                            ->color('secondary')
                            ->action(fn (Forms\Get $get, Forms\Set $set) => $set('code', Str::random(8)));
                    })
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options(DiscountType::array())
                    ->default(DiscountType::PERCENTAGE->value)
                    ->live()
                    ->required(),
                Forms\Components\DateTimePicker::make('start_at'),
                Forms\Components\DateTimePicker::make('end_at'),
                Forms\Components\TextInput::make('value')
                    ->required()
                    ->suffix(fn (Forms\Get $get) => $get('type') === 'percentage' ? '%' : '$')
                    ->numeric()
                    ->default(0),
                Forms\Components\Section::make(__('Usage'))
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('usage_limit')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('usage_count')
                            ->visibleOn('edit')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('usage_per_user')
                            ->required()
                            ->numeric()
                            ->default(1),
                    ]),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('Active'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->formatStateUsing(fn ($state, $record) => $record->type === 'percentage' ? $state.'%' : '$'.$state)
                    ->sortable(),
                Tables\Columns\TextColumn::make('usage_limit')
                    ->formatStateUsing(fn ($state, $record) => "{$record->usage_count} / {$state}")
                    ->label(__('Usage'))
                    ->sortable(query: function ($query, $direction) {
                        return $query->orderBy('usage_count', $direction);
                    }),
                Tables\Columns\IconColumn::make('Usable')
                    ->boolean()
                    ->state(fn ($record) => ! $record->isUsable()),
                Tables\Columns\TextColumn::make('start_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('usage_per_user')
                    ->numeric()
                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromoCodes::route('/'),
            'create' => Pages\CreatePromoCode::route('/create'),
            'edit' => Pages\EditPromoCode::route('/{record}/edit'),
        ];
    }
}
