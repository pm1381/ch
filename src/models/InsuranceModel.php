<?php
namespace App\Models;

use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class InsuranceModel extends BaseModel implements modelInterface{

    protected $fillable = ['discount', 'id', 'price', 'model'];

    public function __construct(){
        $this->table = 'insurance';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return InsuranceModel::all();
    }

    public function getById($id) {
        return InsuranceModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return InsuranceModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return InsuranceModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return InsuranceModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return InsuranceModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($data)
    {
        $result = InsuranceModel::where('id', $data->getId())->get();
        if (count($result)) {
            $res = InsuranceModel::where('id', $data->getId())->update(['price' => $data->getPrice(), 'discount' => $data->getDiscount(), 'model' => $data->getModel()->getId()]);
            if ($res) {
                return $data->getId();
            }
        }
        $tabledata = [
            'price' => $data->getPrice(),
            'discount' => $data->getDiscount(),
            'model' => $data->getModel()->getId()
        ];
        return InsuranceModel::insertGetId($tabledata);
    }
}
