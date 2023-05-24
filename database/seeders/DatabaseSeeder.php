<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create admin
        $admin_group = \App\Models\Group::factory()->create([
            'name' => 'Admins',
            'is_admin_group' => true,
        ]);

        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        $admin_group->users()->attach($admin);

        // create other users
        $groups = \App\Models\Group::factory(5)->create();
        $users = \App\Models\User::factory(20)->create();

        foreach ($groups as $group) {
            $group->users()->attach($users->random(rand(0, 10)));
        }
    }
}
