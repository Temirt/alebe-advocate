<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $email = 'admin@example.com';
        $user = User::firstOrNew(['email' => $email]);
        $user->name = 'Admin';
        $user->password = Hash::make('secret');
        $user->is_admin = true;
        $user->save();
        $this->command->info('Admin user created/updated: '.$email);
    }
}
