<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('category.name'),
            ExportColumn::make('brand.name'),
            ExportColumn::make('name'),
            ExportColumn::make('code'),
            ExportColumn::make('description'),
            ExportColumn::make('slug'),
            ExportColumn::make('image'),
            ExportColumn::make('gallery'),
            ExportColumn::make('quantity'),
            ExportColumn::make('price'),
            ExportColumn::make('is_active'),
            ExportColumn::make('is_new'),
            ExportColumn::make('is_featured'),
            ExportColumn::make('is_best'),
            ExportColumn::make('is_hot'),
            ExportColumn::make('deleted_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your product export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
