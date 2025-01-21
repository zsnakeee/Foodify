<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-s-lock-closed';

    protected static ?string $navigationGroup = 'Users';

    protected static ?int $navigationSort = 21;

    public static function form(Form $form): Form
    {
        $permissionsGrouped = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });
        $permissionsSchemas = $permissionsGrouped->map(function ($permissions, $group) {
            return Forms\Components\Section::make(ucfirst($group)) // Capitalize group name
                ->heading(ucfirst($group))
                ->schema(
                    $permissions->map(function ($permission) {
                        $name = explode('.', $permission->name)[1]; // Extract action (e.g., 'edit', 'delete')

                        return Forms\Components\Checkbox::make('permissions['.$permission->name.']') // Use a unique key for each permission
                            ->label(ucfirst(str_replace('_', ' ', $name))) // Beautify label
                            ->default(true)
//                            ->state(fn () => $form->getRecord()->hasPermissionTo($permission->name)) // Set initial state based on record permissions
                            ->reactive();
                    })->toArray()
                )
                ->columns(2) // Set number of columns in the section
                ->columnSpan(1); // Adjust column span if needed
        });

        //        dd($permissionsGrouped);

        //        $permissionsSchemas = ->map(function ($permission) {
        //            $group = explode('.', $permission->name)[0];
        //            return Forms\Components\Section::make($group)
        //                ->heading(ucfirst($group))
        //                ->schema([
        //                    Forms\Components\Checkbox::make('permissions')
        //                        ->label($permission->name)
        //                        ->default($permission->name)
        //                        ->disabled(),
        //                ]);
        //        });

        //        dd($permissionsSchemas->toArray());

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('guard_name')
                    ->default('web')
                    ->disabled(),
                Forms\Components\Section::make('permissions')
                    ->heading('Permissions')
                    ->schema([
                        Forms\Components\CheckboxList::make('permissions')
                            ->label('')
                            ->relationship('permissions', 'name')
                            ->columns([
                                'default' => 2,
                                'md' => 4,
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('guard_name')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->counts('permissions'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
