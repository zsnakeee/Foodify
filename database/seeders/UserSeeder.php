<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = UserFactory::new()->create([
            'name' => 'Ziad Talaat',
            'email' => 'ziadtallat33@gmail.com',
            'avatar' => ui_avatar('Ziad Talaat'),
        ]);

        $manager = UserFactory::new()->create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'avatar' => ui_avatar('Manager'),
        ]);

        $admin->assignRole('admin');
        $manager->assignRole('manager');
    }
}
