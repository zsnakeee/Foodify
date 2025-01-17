<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Models\Order;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\HtmlString;
use Str;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Order Information')->schema([
                TextEntry::make('number'),
                TextEntry::make('user.name')
                    ->prefixAction(
                        Action::make('View User')
                            ->url(fn (Order $record) => route(EditUser::getRouteName(), $record->user))
                            ->icon('heroicon-s-arrow-top-right-on-square')
                    ),
                TextEntry::make('total')
                    ->money(),
                TextEntry::make('discount')
                    ->money(),
                TextEntry::make('promo_code'),
                TextEntry::make('status')
                    ->badge()
                    ->formatStateUsing(fn (Order $record) => $record->status->getName())
                    ->color(fn (Order $record) => $record->status->getColor()),
                TextEntry::make('payment_status')
                    ->label('Payment Status')
                    ->badge()
                    ->formatStateUsing(fn (Order $record) => $record->payment_status->getName())
                    ->color(fn (Order $record) => $record->payment_status->getColor()),
                TextEntry::make('payment_method')
                    ->label('Payment Method')
                    ->formatStateUsing(fn ($state) => Str::upper($state)),
                TextEntry::make('payment_id')
                    ->copyable()
                    ->label('Payment ID')
                    ->columnSpanFull(),
            ])->columns(4),

            Section::make('Shipping Address')->schema([
                TextEntry::make('shippingAddress.address')
                    ->label('Address'),
                TextEntry::make('shippingAddress.city')
                    ->label('City'),
                TextEntry::make('shippingAddress.state')
                    ->label('State'),
                TextEntry::make('shippingAddress.zip')
                    ->label('ZIP'),
                TextEntry::make('shippingAddress.phone')
                    ->label('Phone'),

            ])->columns(4),

            Section::make('Order Items')->schema([
                RepeatableEntry::make('details')->schema([
                    TextEntry::make('product.name')
                        ->label('Product')
                        ->formatStateUsing(function ($record) {
                            $route = route(EditProduct::getRouteName(), $record->product);

                            return new HtmlString(
                                "<div class='flex align-items-center justify-content-center gap-2'>
                                        <a href='{$route}' target='_blank'>
                                            <img src='{$record->product->image_url}' class='w-8 h-8 object-cover rounded-lg' alt='{$record->product->name}'>
                                        </a>
                                        <span>{$record->product->name}</span>
                                    </div>"
                            );
                        }),
                    TextEntry::make('quantity')
                        ->label('Quantity'),
                    TextEntry::make('price')
                        ->label('Price')
                        ->money(),
                    TextEntry::make('total')
                        ->label('Total')
                        ->money(),
                ])->columns(4),
            ]),
        ]);
    }
}
