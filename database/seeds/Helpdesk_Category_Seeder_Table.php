<?php

use App\User;
use Illuminate\Database\Seeder;

class Helpdesk_Category_Seeder_Table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'helpdesk');
        })->get();

        foreach ($users as $user)
        {
            $user->helpdesk_categories()->sync([1,2,3]);
        }
    }
}
