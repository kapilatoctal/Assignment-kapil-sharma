<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Create User',
            'View User',
            'Edit User',
            'Delete User',
            'Create Post',
            'View Post',
            'Edit Post',
            'Delete Post',
            'Create Category',
            'View Category',
            'Edit Category',
            'Delete Category',
            'Create Tags',
            'View Tags',
            'Edit Tags',
            'Delete Tags',
        ];
        foreach ($permissions as $permission){
            Permission::firstOrCreate([
                'name' => $permission,
                'slug' => Str::slug($permission),
            ]);
        }

    }
}
