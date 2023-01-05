<?php
namespace App\Models;

use App\Entities\PropertyInsurance;
use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class PropertyInsuranceModel extends BaseModel implements modelInterface{

    protected $fillable = ['isComplex', 'city', 'costEachMeter', 'buildAge', 'state', 'unit', 'buildType', 'area', 'discountCode', 'thingPrice'];

    public function __construct(){
        $this->table = 'propertyinsurance';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return PropertyInsuranceModel::all();
    }

    public function getById($id) {
        return PropertyInsuranceModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return PropertyInsuranceModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return PropertyInsuranceModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return PropertyInsuranceModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return PropertyInsuranceModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($data)
    {
        $tableData = [
            'isComplex' => $data->getIsComplex(),
            'city' => $data->getCity()->getId(),
            'costEachMeter' => $data->getCost()->getId(),
            'buildAge' => $data->getBuildAge()->getId(),
            'state' => $data->getState(),
            'unit' => $data->getUnit(),
            'buildType' => $data->getBuildType()->getId(),
            'area' => $data->getArea(),
            'discountCode' => $data->getDiscountCode(),
            'thingPrice' => $data->getHouseholdPrice()
        ];
        $result = PropertyInsuranceModel::where('id', $data->getId())->get();
        if (count($result)) {
            $res = PropertyInsuranceModel::where('id', $data->getId())->update($tableData);
            if ($res) {
                return $data->getId();
            }
        }
        return PropertyInsuranceModel::insertGetId($tableData);
    }
}
