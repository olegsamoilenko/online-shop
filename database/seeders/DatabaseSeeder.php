<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Str;


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
      RoleSeeder::class,
      CategorySeeder::class,
      TagSeeder::class,
      ImageSeeder::class,
      ProductSeeder::class,
      OrderSeeder::class,
      OneClickOrderSeeder::class,
    ]);

    $adminRole = Role::where('slug', 'admin')->first();
    $managerRole = Role::where('slug', 'manager')->first();
    $userRole = Role::where('slug', 'user')->first();


     \App\Models\User::factory()
       ->count(5)
       ->hasAttached($userRole)
       ->create();

    \App\Models\User::factory()
      ->count(5)
      ->hasAttached($managerRole)
      ->create();

    \App\Models\User::factory()
      ->count(5)
      ->hasAttached($adminRole)
      ->create();

    $user = new User();
    $user->name = 'admin';
    $user->email = 'admin@admin.com';
    $user->email_verified_at = now();
    $user->password = bcrypt('11111111'); // 11111111
    $user->rules = 1;
    $user->remember_token = Str::random(10);
    $user->save();
    $user->roles()->attach($adminRole);
    $user->roles()->attach($managerRole);
  }
}
