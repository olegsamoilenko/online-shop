<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role = new Role();
      $role->name = 'User';
      $role->slug = 'user';
      $role->save();

      $role = new Role();
      $role->name = 'Administrator';
      $role->slug = 'admin';
      $role->save();

      $role = new Role();
      $role->name = 'Manager';
      $role->slug = 'manager';
      $role->save();
    }
}
