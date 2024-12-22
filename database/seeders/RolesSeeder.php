<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = RoleEnum::cases();

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role->value, 'guard_name' => 'api']);
        }
    }
}
