<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission for normal members

        Permission::firstOrCreate(['name' => 'dashboard','display_name' => 'Dashboard','description' => 'Members Dashboard']);
        Permission::firstOrCreate(['name' => 'manage_ticket','display_name' => 'Manage Ticket','description' => 'Members Manage Ticket']);
        Permission::firstOrCreate(['name' => 'create_ticket','display_name' => 'Create Ticket','description' => 'Members Create Ticket']);
        Permission::firstOrCreate(['name' => 'edit_ticket','display_name' => 'Edit Ticket','description' => 'Members Edit Ticket']);
        Permission::firstOrCreate(['name' => 'show_ticket','display_name' => 'Show Ticket','description' => 'Members Show Ticket']);
        Permission::firstOrCreate(['name' => 'delete_ticket','display_name' => 'Delete Ticket','description' => 'Members Delete Ticket']);
        Permission::firstOrCreate(['name' => 'mark_solved_ticket','display_name' => 'Mark Solved Ticket','description' => 'Members Mark as Solved Ticket']);
        Permission::firstOrCreate(['name' => 'reopen_ticket','display_name' => 'Re-Open Ticket','description' => 'Members Reopen Ticket']);
        Permission::firstOrCreate(['name' => 'submit_response','display_name' => 'Submit Ticket Response','description' => 'Members Submit Ticket Response']);


        //Permission for helpdesk

        Permission::firstOrCreate(['name' => 'helpdesk_dashboard','display_name' => 'Helpdesk Dashboard','description' => 'Helpdesk Dashboard']);
        Permission::firstOrCreate(['name' => 'helpdesk_manage_ticket','display_name' => 'Helpdesk Manage Ticket','description' => 'Helpdesk Manage Ticket']);
        Permission::firstOrCreate(['name' => 'helpdesk_create_ticket','display_name' => 'Helpdesk Create Ticket','description' => 'Helpdesk Create Ticket']);
        Permission::firstOrCreate(['name' => 'helpdesk_edit_ticket','display_name' => 'Helpdesk Edit Ticket','description' => 'Helpdesk Edit Ticket']);
        Permission::firstOrCreate(['name' => 'helpdesk_show_ticket','display_name' => 'Helpdesk Show Ticket','description' => 'Helpdesk Show Ticket']);
        Permission::firstOrCreate(['name' => 'helpdesk_delete_ticket','display_name' => 'Helpdesk Delete Ticket','description' => 'Helpdesk Delete Ticket']);
        Permission::firstOrCreate(['name' => 'helpdesk_mark_closed_ticket','display_name' => 'Helpdesk Mark Closed Ticket','description' => 'Helpdesk Mark as Closed Ticket']);
        Permission::firstOrCreate(['name' => 'helpdesk_mark_solved_ticket','display_name' => 'Helpdesk Mark Solved Ticket','description' => 'Helpdesk Mark as Solved Ticket']);
        Permission::firstOrCreate(['name' => 'helpdesk_reopen_ticket','display_name' => 'Helpdesk Re-Open Ticket','description' => 'Helpdesk Reopen Ticket']);
        Permission::firstOrCreate(['name' => 'helpdesk_submit_response','display_name' => 'Helpdesk Submit Response','description' => 'Helpdesk Submit Response']);

        //Permission for Admin
        //Manage User

        Permission::firstOrCreate(['name' => 'manage_user','display_name' => 'Admin Manage User','description' => 'Admin Manage User']);
        Permission::firstOrCreate(['name' => 'create_user','display_name' => 'Admin Create User','description' => 'Admin Create User']);
        Permission::firstOrCreate(['name' => 'edit_user','display_name' => 'Admin Edit User','description' => 'Admin Edit User']);
        Permission::firstOrCreate(['name' => 'show_user','display_name' => 'Admin Show User','description' => 'Admin Show User']);
        Permission::firstOrCreate(['name' => 'delete_user','display_name' => 'Admin Delete User','description' => 'Admin Delete User']);

        //Manage Roles
        Permission::firstOrCreate(['name' => 'manage_role','display_name' => 'Admin Manage Role','description' => 'Admin Manage Role']);
        Permission::firstOrCreate(['name' => 'create_role','display_name' => 'Admin Create Role','description' => 'Admin Create Role']);
        Permission::firstOrCreate(['name' => 'edit_role','display_name' => 'Admin Edit Role','description' => 'Admin Edit Role']);
        Permission::firstOrCreate(['name' => 'show_role','display_name' => 'Admin Show Role','description' => 'Admin Show Role']);
        Permission::firstOrCreate(['name' => 'delete_role','display_name' => 'Admin Delete Role','description' => 'Admin Delete Role']);

        //Manage Permissions
        Permission::firstOrCreate(['name' => 'manage_permission','display_name' => 'Admin Manage Permission','description' => 'Admin Manage Permission']);
        Permission::firstOrCreate(['name' => 'create_permission','display_name' => 'Admin Create Permission','description' => 'Admin Create Permission']);
        Permission::firstOrCreate(['name' => 'edit_permission','display_name' => 'Admin Edit Permission','description' => 'Admin Edit Permission']);
        Permission::firstOrCreate(['name' => 'show_permission','display_name' => 'Admin Show Permission','description' => 'Admin Show Permission']);
        Permission::firstOrCreate(['name' => 'delete_permission','display_name' => 'Admin Delete Permission','description' => 'Admin Delete Permission']);

    }
}
