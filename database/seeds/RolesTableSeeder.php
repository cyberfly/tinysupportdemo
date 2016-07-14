<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::firstOrCreate(['name' => 'admin','display_name' => 'Administrator','description' => 'Administrator Role']);

        //attach admin permission

        $admin_permissions = ['manage_user','create_user','edit_user','delete_user','show_user','manage_role','create_role','edit_role','delete_role','show_role','manage_permission','create_permission','edit_permission','delete_permission','show_permission'];
        $admin_permissions_id = $this->getPermissionsId($admin_permissions);

        $admin_role->perms()->sync($admin_permissions_id);

        //create helpdesk role

        $helpdesk_role = Role::firstOrCreate(['name' => 'helpdesk','display_name' => 'Helpdesk','description' => 'Helpdesk Role']);

        //attach helpdesk permission

        $helpdesk_permissions = ['helpdesk_dashboard','helpdesk_manage_ticket','helpdesk_create_ticket','helpdesk_edit_ticket','helpdesk_show_ticket','helpdesk_delete_ticket','helpdesk_mark_closed_ticket','helpdesk_mark_solved_ticket','helpdesk_reopen_ticket','helpdesk_submit_response'];
        $helpdesk_permissions_id = $this->getPermissionsId($helpdesk_permissions);

        $helpdesk_role->perms()->sync($helpdesk_permissions_id);

        //create members role

        $members_role = Role::firstOrCreate(['name' => 'members','display_name' => 'Members','description' => 'Normal Members']);

        //attach members permission

        $members_permissions = ['dashboard','manage_ticket','create_ticket','edit_ticket','show_ticket','delete_ticket','mark_solved_ticket','reopen_ticket','submit_response'];
        $members_permissions_id = $this->getPermissionsId($members_permissions);

        $members_role->perms()->sync($members_permissions_id);

    }

    function getPermissionsId($permissions_list)
    {
        $permissions_id = [];

        foreach ($permissions_list as $permission_name)
        {
            $permission = Permission::whereName($permission_name)->first();
            $permissions_id[] = $permission->id;
        }

        return $permissions_id;
    }
}
