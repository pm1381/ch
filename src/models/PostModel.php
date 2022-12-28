<?php
namespace App\Models;

use App\Classes\Date;
use App\Entities\Post as ClassesPost;
use Illuminate\Database\Eloquent\Model;

class PostModel extends BaseModel{

    public function __construct(){
        $this->table = 'post';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return PostModel::all(['title', 'description', 'user']);
    }

    public function getById($id) {
        return PostModel::where('id', '=', $id)->select('title', 'description', 'user')->get();
    }

    public function updateById(ClassesPost $post, $id) {
        $data['updated_at'] = Date::now();
        if ($post->getTitle() != "") {
            $data['title'] = $post->getTitle();
        }
        if ($post->getDescription() != "") {
            $data['description'] = $post->getDescription();
        }
        if ($post->getUser() != "") {
            $data['user'] = $post->getUser();
        }

        return PostModel::where('id', $id)->update($data);
    }

    public function insertPost(ClassesPost $post) {
        $data = [
            'title' => $post->getTitle(),
            'description'  => $post->getDescription(),
            'user' => $post->getUser(),
            'updated_at' => Date::now(),
            'created_at' => Date::now()
        ]; 
        return PostModel::insert($data);
    }
}
