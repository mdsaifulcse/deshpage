<?php

namespace Database\Seeders;

use Database\Factories\PermissionFactory;
use Database\Factories\UserRolePermissionFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            PermissionSeeder::class,
            UserRolePermissionsSeeder::class,
            MenuSeeder::class
        ]);

        // \App\Models\User::factory(2)->create();
    }
}
