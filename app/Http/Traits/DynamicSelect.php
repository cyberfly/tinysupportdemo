<?php

namespace App\Http\Traits;

use App\Category;
use App\Priority;
use App\Role;
use App\User;

trait DynamicSelect{

    public function getCategoriesSelect()
    {
        $categories = Category::lists('category_name','id');
        $categories = [''=>'Select Category'] + $categories->all();

        return $categories;
    }

    public function getPrioritiesSelect()
    {
        $priorities = Priority::lists('priority_name','id');
        $priorities = [''=>'Select Priority'] + $priorities->all();

        return $priorities;
    }

    /**
     * @return array
     */
    public function getCustomersSelect()
    {
//        $customers = Role::where('name', 'members')->users()->get();
//        $role = Role::find(3)->users()->get();

        $customers = User::lists('name','id');
        $customers = [''=>'Select Customer'] + $customers->all();

        return $customers;
    }

}