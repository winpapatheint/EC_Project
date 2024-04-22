<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'product.list']);
        Permission::create(['name' => 'product.add']);
        Permission::create(['name' => 'product.edit']);
        Permission::create(['name' => 'product.delete']);
        Permission::create(['name' => 'order.list']);
        Permission::create(['name' => 'order.add']);
        Permission::create(['name' => 'order.edit']);
        Permission::create(['name' => 'order.delete']);
        Permission::create(['name' => 'subseller.list']);
        Permission::create(['name' => 'subseller.add']);
        Permission::create(['name' => 'subseller.edit']);
        Permission::create(['name' => 'subseller.delete']);
        Permission::create(['name' => 'help.list']);
        Permission::create(['name' => 'help.add']);
        Permission::create(['name' => 'help.edit']);
        Permission::create(['name' => 'help.delete']);
        Permission::create(['name' => 'review.list']);
        Permission::create(['name' => 'review.add']);
        Permission::create(['name' => 'review.edit']);
        Permission::create(['name' => 'review.delete']);
        Permission::create(['name' => 'profile']);
        Permission::create(['name' => 'dashboard']);
    }
}
