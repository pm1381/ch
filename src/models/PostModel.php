<?php
namespace App\Models;

use App\Classes\Date;
use App\Classes\Post as ClassesPost;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model{
    use BaseModel;

    public function __construct(){
        $this->table = 'post';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return UserModel::all(['title', 'description', 'user']);
    }

    public function getById($id) {
        return UserModel::where('id', '=', $id)->select('title', 'user')->get();
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

        return UserModel::where('userId', $id)->update($data);
    }

    public function insertUser(ClassesPost $post) {
        $data = [
            'title' => $post->getTitle(),
            'description'  => $post->getDescription(),
            'user' => $post->getUser(),
            'updated_at' => Date::now(),
            'created_at' => Date::now()
        ]; 
        return UserModel::insert($data);
    }
}