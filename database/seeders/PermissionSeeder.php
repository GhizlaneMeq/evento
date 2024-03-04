<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'event_access',
            ],
            [
                'name' => 'event_edit',
            ],
            [
                'name' => 'event_delete',
            ],            
            [
                'name' => 'event_create',
            ],
        ];
        foreach ($permissions as $permission){
            Permission::create($permission);
        }
    }
}
