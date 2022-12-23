<?php
namespace App\Models;

use App\Classes\Date;
use App\Classes\Redis;
use App\Helpers\Tools;
use App\Services\User as ClassesUser;
use Illuminate\Database\Eloquent\Model;

class UserModel extends BaseModel{

    protected $fillable = ['email', 'name'];

    public function __construct(){
        $this->table = 'user';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        $redis = new Redis();
        $redisResult = $redis->get('allUsers');
        if ($redisResult) {
            return $redisResult;
        }
        $res = json_encode(UserModel::all(['email', 'name', 'admin']));
        $redis->store('allUsers', $res);
        $redis->expireDate('allUsers', 60);
        return $res;
    }

    //accessor
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    //mutator
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value); ////mutator does not work with insert. only with create
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
        return UserModel::where('id', $id)->update($data);
    }

    public function updatePassword(ClassesUser $user, $newPass)
    {
        return UserModel::where('email', $user->getEmail())->where('remember_token', '=', $user->getRemeberToken())->update(['updated_at' => Date::now() , 'password' => $newPass]);        
    }

    public function updateToken(ClassesUser $user)
    {
        return UserModel::where('id', $user->getId())->update(['updated_at' => Date::now() , 'token' => $user->getToken()]);
    }

    public function updateRememberToken(ClassesUser $user)
    {
        return UserModel::where('email', '=', $user->getEmail())->update(['updated_at' => Date::now(), 'remember_token' => $user->getRemeberToken()]);
    }

    public function insertUser(ClassesUser $user) {
        $hashedPassword = $user->hashPassword(); //first check if user logged in before;
        if(count($this->loginCheck($user)) > 0) {
            return false;
        }
        $data = [
            'email' => $user->getEmail(),
            'name'  => $user->getName(),
            'password' => $hashedPassword,
            'updated_at' => Date::now(),
            'created_at' => Date::now(),
            'token' => $user->getToken()
        ]; 
        return UserModel::insert($data);
    }

    public function loginCheck(ClassesUser $user) {
        $email = $user->getEmail();
        $password = $user->getPassword(); // it is real password. not hashed

        $res = UserModel::where('email', '=', $email)->get();
        foreach ($res as $each) {
            if ($user->checkPassword($password, $each->password))
                return $res;
        }
        return [];
    }
}