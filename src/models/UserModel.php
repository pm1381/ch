<?php
namespace App\Models;

use App\Classes\Date;
use App\Classes\User as ClassesUser;
use Illuminate\Database\Eloquent\Model;

class UserModel extends BaseModel{

    protected $fillable = ['email', 'name'];

    public function __construct(){
        $this->table = 'user';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    //accessor
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getAll() {
        return UserModel::all(['email', 'name', 'admin']);
    }

    //mutator
    public function setNameAttribute($value)
    {
        //mutator does not work with insert. only with create
        $this->attributes['name'] = strtoupper($value);
    }

    public function getById($id) {
        return UserModel::where('id', '=', $id)->select('email', 'name')->get();
    }

    public function getByToken($token){
        return UserModel::where('token', '=', $token)->take(1)->get();
    }

    public function updateById(ClassesUser $user, $id) {
        $data['updated_at'] = Date::now();
        if ($user->getEmail() != "") {
            $data['email'] = $user->getEmail();
        }
        if ($user->getName() != "") {
            $data['name'] = $user->getName();
        }
        if ($user->getPassword() != "") {
            $data['password'] = $user->getPassword();
        }

        return UserModel::where('userId', $id)->update($data);
    }

    public function insertUser(ClassesUser $user) {
        $data = [
            'email' => $user->getEmail(),
            'name'  => $user->getName(),
            'password' => $user->getPassword(),
            'updated_at' => Date::now(),
            'created_at' => Date::now(),
            'token' => $user->getToken()
        ]; 
        return UserModel::insert($data);
    }

    public function loginCheck(ClassesUser $user) {
        $email = $user->getEmail();
        $name = $user->getName();
        $password = $user->getPassword();

        return UserModel::where('email', '=', $email)->where('name', '=', $name)->where('password', '=', $password)->take(1)->get();
    }
}