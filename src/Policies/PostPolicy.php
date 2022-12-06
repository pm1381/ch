<?php

namespace App\Policies;

use App\Classes\User;
use App\Models\PostModel;
use App\Models\UserModel;

class PostPolicy
{
    public function __construct(){}

    public function create(UserModel $user)
    {

    }

    public function update(UserModel $user, PostModel $post)
    {

    }

    public function delete(UserModel $user, PostModel $post)
    {

    }

    public function softDelete(UserModel $user, PostModel $post)
    {
        
    }

    public function view(UserModel $user, PostModel $post)
    {

    }
}