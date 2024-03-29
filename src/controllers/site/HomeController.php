<?php

namespace App\Controllers\Site;

use App\Classes\Gate;
use App\Entities\Post;
use App\Entities\User;
use App\Controllers\Refrence\SiteRefrenceController;
use App\Models\PostModel;

class HomeController extends SiteRefrenceController {


    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $user = new User();
        $currentUser = $user->isLogin()['user'];
        $user->setName($currentUser['name']);
        $user->setEmail($currentUser['email']);
        $user->setAdmin($currentUser['admin']);
        $user->setId($currentUser['id']);
        
        $postModel = new PostModel();
        $result = $postModel->getById(1);
        $post = new Post();
        $post->setTitle($result[0]['title']);
        $post->setDescription($result[0]['description']);
        $post->setUser($result[0]['user']);

        // testing authorization
        print_f(Gate::allows('post_update', $user, $post));
    }
}