<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Registered';
        $role->save();
        $role->givePermissionTo([
            'homepage-view',
            'user-profile',
        ]);

        $role = new Role();
        $role->name = 'Administrator';
        $role->save();
        $role->givePermissionTo([
            'homepage-view',
            'role-list',
            'role-view',
            'role-create',
            'role-edit',
            'role-delete',
            'role-add-permission',
            'role-remove-permission',
            'user-profile',
            'user-list',
            'user-view',
            'user-create',
            'user-edit',
            'user-delete',
            'user-profile',
            'user-assign-roles',
            'user-remove-roles',
            'user-add-permission',
            'user-remove-permission',
            'permission-list',
            'permission-view',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'page-list',
            'page-view',
            'page-create',
            'page-edit',
            'page-delete',
            'category-list',
            'category-view',
            'category-create',
            'category-edit',
            'category-delete',
            'language-list',
            'language-view',
            'language-create',
            'language-edit',
            'language-delete',
            'translation-list',
            'translation-view',
            'translation-create',
            'translation-edit',
            'translation-delete',
            'component-list',
            'component-view',
            'component-create',
            'component-edit',
            'component-delete',
            'menu-list',
            'menu-view',
            'menu-create',
            'menu-edit',
            'menu-delete',
            'menuitem-list',
            'menuitem-view',
            'menuitem-create',
            'menuitem-edit',
            'menuitem-delete',
            'image-list',
            'image-view',
            'image-create',
            'image-edit',
            'image-delete',
            'imageCategory-list',
            'imageCategory-view',
            'imageCategory-create',
            'imageCategory-edit',
            'imageCategory-delete',
            'site-list',
            'site-view',
            'site-create',
            'site-edit',
            'site-delete',
        ]);

        $role = new Role();
        $role->name = 'Partner';
        $role->save();
        $role->givePermissionTo([
            'homepage-view',
            'user-profile',
        ]);

        $role = new Role();
        $role->name = 'Sales';
        $role->save();
        $role->givePermissionTo([
            'homepage-view',
            'user-profile',
        ]);

        $role = new Role();
        $role->name = 'Active';
        $role->save();
        $role->givePermissionTo([
            'homepage-view',
            'user-profile',
        ]);


        $role = new Role();
        $role->name = 'Author';
        $role->save();
        $role->givePermissionTo([
            'page-create',
            'page-edit',
            'page-delete',
            'category-create',
            'category-edit',
            'category-delete',
        ]);
    }
}
