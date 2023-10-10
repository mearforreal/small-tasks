<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Role;
use App\Models\User;

use Illuminate\Support\Facades\Hash;



class ApplicationService
{

    public function filter($authUser, $categoryId)
    {

        $query = Application::where('user_id', $authUser->id);

        // If the user is a manager, don't filter by user_id
        if ($authUser->roles->contains('title', Role::ROLE_MANAGER)) {
            $query = Application::query();
        }

        // If a category_id is provided, filter by category
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return  $query->paginate(10);
    }
}
