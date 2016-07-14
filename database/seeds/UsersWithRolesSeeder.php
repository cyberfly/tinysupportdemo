<?php

use Illuminate\Database\Seeder;

class UsersWithRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create 2 admin

        factory(App\User::class, 'pass123', 2)->create()->each(function($u) {
            $admin = App\Role::whereName('admin')->first();
            $u->roles()->attach($admin->id);
        });

        //create 10 helpdesk

        factory(App\User::class, 'pass123', 10)->create()->each(function($u) {
            $helpdesk = App\Role::whereName('helpdesk')->first();
            $u->roles()->attach($helpdesk->id);
        });

        //create 20 members

        factory(App\User::class, 'pass123', 20)->create()->each(function($u) {
            $members = App\Role::whereName('members')->first();
            $u->roles()->attach($members->id);
        });

    }
}
