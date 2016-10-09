<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use DCN\RBAC\Models\Role;
use DCN\RBAC\Models\Permission;


class AddRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rbac:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Roles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $superAdminRole = Role::create([
            'name' => 'Super Admin',
            'slug' => 'super.admin',
            'description' => 'Super Admin', // optional
            'parent_id' => NULL, // optional, set to NULL by default
        ]);

        $adminRole = Role::create([
            'name' => 'Account Admin',
            'slug' => 'admin',
        ]);

        $moderatorRole = Role::create([
            'name' => 'Moderator',
            'slug' => 'moderator',
            'parent_id' => NULL, // optional, set to NULL by default
        ]);

        $staffRole = Role::create([
            'name' => 'Staff',
            'slug' => 'staff',
        ]);

        $user = User::find(1);
        $user->attachRole($superAdminRole);

        $createAccountPermission = Permission::create([
            'name' => 'Create account',
            'slug' => 'create.account',
            'description' => '', // optional
        ]);

        $deleteAccountPermission = Permission::create([
            'name' => 'Delete account',
            'slug' => 'delete.account',
        ]);


        $superAdminRole->attachPermission($createAccountPermission);
        $superAdminRole->attachPermission($deleteAccountPermission);


    }
}
