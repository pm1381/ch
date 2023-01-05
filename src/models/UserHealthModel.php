<?php
namespace App\Models;

use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class UserHealthModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'ageRange', 'insurer', 'familyRelation', 'healthInsurance'];

    public function __construct(){
        $this->table = 'healthinsurancetouser';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return UserHealthModel::all();
    }

    public function getById($id) {
        return UserHealthModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return UserHealthModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return UserHealthModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return UserHealthModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return UserHealthModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($data)
    {
        $tabledata = [
            'ageRange' => $data->getAgeRange()->getId(),
            'insurer' => $data->getInsurer()->getId(),
            'familyRelation' => $data->getRelation()->getId(),
            'healthInsurance' => $data->getHealthInsurance()->getHealthId()
        ];
        $result = UserHealthModel::where('id', $data->getId())->get();
        if (count($result)) {
            return UserHealthModel::where('id', $data->getId())->update($tabledata);
        }
        return UserHealthModel::create($tabledata);
    }
}
