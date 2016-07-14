<?php

namespace App\Http\Traits;

use App\Category;
use App\Priority;

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

}