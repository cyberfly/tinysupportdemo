<?php

namespace App\Http\Traits;

use App\Category;
use App\Priority;

trait DynamicSelect{

    public function getCategories()
    {
        $categories = Category::lists('category_name','id');
        $categories = [''=>'Select Category'] + $categories->all();

        return $categories;
    }

    public function getPriorities()
    {
        $priorities = Priority::lists('priority_name','id');
        return $priorities;
    }

}