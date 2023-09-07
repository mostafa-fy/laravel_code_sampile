<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

   public function setUp(): void
    {
        parent::setUp();
        
        $this->admin = $this->createAdmin();
    }

   private function createAdmin()
    {
      return  User::factory()->create();
    }
    
    public function test_returns_users(): void
    {
        $admin = $this->admin;

        $response = $this->actingAs($admin)->get('/users');
        
        $response->assertViewHas('users', function($users)use($admin) {
            return $users->contains($admin);
        });
        $response->assertStatus(200);
    }

    public function test_store_user(): void
    {
        $admin = $this->admin;
        Permission::create(['name'=>'create product']);

        $newUser = [
            'name'=>'test',
            'email'=>'test@gmail.com',
            'password'=>Hash::make('password'),
            'permissions'=>'create product'
        ];

        $response = $this->actingAs($admin)->post('/users',$newUser);
        unset($newUser['permissions']);
        $this->assertDatabaseHas('users',$newUser);
        $response->assertStatus(302);
    }

    public function test_invalid_store_user(): void
    {
        $admin = $this->admin;
        Permission::create(['name'=>'create product']);
        $newUser = [
            'name'=>'',
            'email'=>'',
            'password'=>Hash::make('password'),
        ];

        $response = $this->actingAs($admin)->post('/users',$newUser);

        // $response->assertSessionHasErrors(['name','email']);
        //OR
        $response->assertInvalid(['name','email']);
        $response->assertStatus(302);

    }
    
}
