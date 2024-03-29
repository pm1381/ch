<?php

namespace App\Policies;

use App\Entities\Post;
use App\Entities\User;

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
        print_f("do not have permission to update");
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
