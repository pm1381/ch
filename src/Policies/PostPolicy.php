<?php

namespace App\Policies;

use App\Services\Post;
use App\Services\User;

class PostPolicy
{
    public function create(User $user)
    {
        if ($user->getAdmin() == 1) {
            print_f("is admin - can create");
            return true;
        }
        return false;
    }

    public function update(User $user, Post $post)
    {
        if ($user->getId() == $post->getUser()) {
            print_f("user can edit/create this post");
            return true;
        }
        return false;
    }

    public function delete(User $user, Post $post)
    {

    }

    public function softDelete(User $user, Post $post)
    {
        
    }

    public function view(User $user, Post $post)
    {

    }
}