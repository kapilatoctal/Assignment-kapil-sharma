<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Admin = User::firstorCreate([
            'name' => 'Admin User',
            'email' => 'Admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$IQaH3lb88XXBPDotvVhUaOWw/ZN3tsbNSIjLLFq3kPypcpulgyeyy', // secret@1
            'remember_token' => Str::random(10),
        ]);

        $Author = User::firstorCreate([
            'name' => 'Author User',
            'email' => 'Writer@author.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$mjSUi1e0LiCrYWnp5obv.eMtqbNJS4qb1VhNrG/gZS6oLoasnf4My', // Author@1
            'remember_token' => Str::random(10),
        ]);

        $User = User::firstorCreate([
            'name' => 'Normal User',
            'email' => 'normal@user.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$QNAAn2c0I/6QM.IDMBN7B.ZePv66NlgLUR2FLjfiJtW3WZi45.HQa', // Normal@1
            'remember_token' => Str::random(10),
        ]);

        $Admin->roles()->attach(Role::whereSlug('admin')->first());
        $Author->roles()->attach(Role::whereSlug('author')->first());
        $User->roles()->attach(Role::whereSlug('user')->first());

        User::factory(10)->create();
        foreach (User::whereDoesntHave('roles')->get() as  $user) {
            $user->roles()->attach(mt_rand(2,3));
        }
    }
}
