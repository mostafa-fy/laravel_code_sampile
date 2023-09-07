<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function getUser()
    {
      return  User::with('permissions')->paginate(10);
    }

    public static function store($data)
    {
      $user =  User::create($data);
      $user->syncPermissions($data['permissions']);
    }
}