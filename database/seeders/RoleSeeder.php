<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // add role array and create roles
        $Admin;
        $Author;
        $User;
        $Roles = [
            'Admin',
            'Author',
            'User'
        ];
        
        foreach ($Roles as $role){
            $$role = Role::firstOrCreate([
                'name' => $role,
                'slug' => Str::slug($role),
            ]);
        }

        foreach (Permission::all() as $permission) {
            $Admin->permissions()->attach($permission);
            if(in_array($permission->slug,['create-post','view-post','edit-post','delete-post','create-category','view-category', 'edit-category','create-tags','view-tags','edit-tags']))
            {
                $Author->permissions()->attach($permission);
            }
            if(in_array($permission->slug,['view-post']))
            {
                $User->permissions()->attach($permission);
            }
        }
    }
}
