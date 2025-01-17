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

        Permission::create(['name' => 'product.access']);
        Permission::create(['name' => 'product.create']);
        Permission::create(['name' => 'product.edit']);
        Permission::create(['name' => 'product.delete']);

        Permission::create(['name' => 'category.access']);
        Permission::create(['name' => 'category.create']);
        Permission::create(['name' => 'category.edit']);
        Permission::create(['name' => 'category.delete']);

        Permission::create(['name' => 'brand.access']);
        Permission::create(['name' => 'brand.create']);
        Permission::create(['name' => 'brand.edit']);
        Permission::create(['name' => 'brand.delete']);

        Permission::create(['name' => 'promo.access']);
        Permission::create(['name' => 'promo.create']);
        Permission::create(['name' => 'promo.edit']);
        Permission::create(['name' => 'promo.delete']);

        Permission::create(['name' => 'order.access']);
        Permission::create(['name' => 'order.edit']);
        Permission::create(['name' => 'order.delete']);

        Permission::create(['name' => 'user.access']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.delete']);

        Permission::create(['name' => 'role.access']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.edit']);
        Permission::create(['name' => 'role.delete']);

        Permission::create(['name' => 'permission.access']);
        Permission::create(['name' => 'permission.create']);
        Permission::create(['name' => 'permission.edit']);
        Permission::create(['name' => 'permission.delete']);

        Permission::create(['name' => 'setting.access']);
        Permission::create(['name' => 'setting.edit']);

        $manager = Role::create(['name' => 'manager']);
        $manager->givePermissionTo([
            'product.access',
            'product.create',
            'product.edit',
            'product.delete',
            'category.access',
            'category.create',
            'category.edit',
            'category.delete',
            'brand.access',
            'brand.create',
            'brand.edit',
            'brand.delete',
            'promo.access',
            'promo.create',
            'promo.edit',
            'promo.delete',
            'order.access',
            'order.edit',
            'order.delete',
            'user.access',
            'user.edit',
            'user.delete',
        ]);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
