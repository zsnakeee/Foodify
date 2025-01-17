<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'product.view']);
        Permission::create(['name' => 'product.create']);
        Permission::create(['name' => 'product.edit']);
        Permission::create(['name' => 'product.delete']);

        Permission::create(['name' => 'category.view']);
        Permission::create(['name' => 'category.create']);
        Permission::create(['name' => 'category.edit']);
        Permission::create(['name' => 'category.delete']);

        Permission::create(['name' => 'brand.view']);
        Permission::create(['name' => 'brand.create']);
        Permission::create(['name' => 'brand.edit']);
        Permission::create(['name' => 'brand.delete']);

        Permission::create(['name' => 'promo.view']);
        Permission::create(['name' => 'promo.create']);
        Permission::create(['name' => 'promo.edit']);
        Permission::create(['name' => 'promo.delete']);

        Permission::create(['name' => 'order.view']);
        Permission::create(['name' => 'order.create']);
        Permission::create(['name' => 'order.edit']);
        Permission::create(['name' => 'order.delete']);

        Permission::create(['name' => 'user.view']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.delete']);

        Permission::create(['name' => 'role.view']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.edit']);
        Permission::create(['name' => 'role.delete']);
        Permission::create(['name' => 'role.assign']);

        Permission::create(['name' => 'permission.view']);
        Permission::create(['name' => 'permission.create']);
        Permission::create(['name' => 'permission.edit']);
        Permission::create(['name' => 'permission.delete']);

        Permission::create(['name' => 'setting.view']);
        Permission::create(['name' => 'setting.edit']);

        $manager = Role::create(['name' => 'manager']);
        $manager->givePermissionTo([
            'product.view',
            'product.create',
            'product.edit',
            'product.delete',
            'category.view',
            'category.create',
            'category.edit',
            'category.delete',
            'brand.view',
            'brand.create',
            'brand.edit',
            'brand.delete',
            'promo.view',
            'promo.create',
            'promo.edit',
            'promo.delete',
            'order.view',
            'order.create',
            'order.edit',
            'order.delete',
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
        ]);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
