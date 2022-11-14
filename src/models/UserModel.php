<?php
namespace App\Models;

use App\Classes\User as ClassesUser;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model{
    use BaseModel;

    public function __construct(){
        $this->table = 'user';
        $this->primaryKey = 'userId';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return UserModel::all(['userPhone', 'userName']);
    }

    public function getById($id) {
        return UserModel::where('userId', '=', $id)->select('userPhone', 'userName')->get();
    }

    public function updateById(ClassesUser $user, $id) {
        $data = [
            'userPhone' => $user->getUserPhone(),
            'userName'  => $user->getUserName()
        ];
        return UserModel::where('userId', $id)->update($data);
    }

    public function insertUser(ClassesUser $user) {
        $data = [
            'userPhone' => $user->getUserPhone(),
            'userName'  => $user->getUserName()
        ]; 
        return UserModel::insert($data);
    }
}