<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $permissions = [
        'create product',
        'modify product',
        'delete product'
       ];

       foreach ($permissions as $permission) {
        Permission::create(['name'=>$permission]);
       }

      $user = User::create(
        [
            'name'=>'Admin',
            'email'=>'Admin@gmail.com',
            'password'=>'00000000'
        ]
        );

        $user->givePermissionTo($permissions);
    }
}
