<?php
namespace App\Models;

use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class CoverHealthModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'cover', 'maxPay', 'healthInsurance'];

    public function __construct(){
        $this->table = 'covertoinsurance';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return CoverHealthModel::all();
    }

    public function getById($id) {
        return CoverHealthModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return CoverHealthModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return CoverHealthModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return CoverHealthModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return CoverHealthModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($data)
    {
        $result = CoverHealthModel::where('id', $data->getId())->get();
        if (count($result)) {
            return CoverHealthModel::where('id', $data->getId())->update(['cover' => $data->getCover()->getId(), 'maxPay' => $data->getMaxPay(), 'healthInsurance' => $data->getHealthInsurance()->getId()]);
        }
        $tabledata = [
            'cover' => $data->getCover()->getId(),
            'maxPay' => $data->getMaxPay(),
            'healthInsurance' => $data->getHealthInsurance()->getId()
        ];
        return CoverHealthModel::create($tabledata);
    }
}
