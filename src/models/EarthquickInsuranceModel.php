<?php
namespace App\Models;


use App\Entities\PropertyInsurance;
use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class EarthquickInsurance extends BaseModel implements modelInterface{

    protected $fillable = ['insurance', 'property', 'name'];
    public function __construct(){
        $this->table = 'earthquickinsurance';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return EarthquickInsurance::all();
    }

    public function getById($id) {
        return EarthquickInsurance::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return EarthquickInsurance::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return EarthquickInsurance::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return EarthquickInsurance::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return EarthquickInsurance::where('id', $ids)->delete();
    }

    public function saveOrUpdate($data)
    {
        $tableData = ['name' => $data->getName()];
        $propertyEntity = new PropertyInsurance();
        $propertyEntity->setUnit($data->getUnit())->setHouseholdPrice($data->getHouseholdPrice())
            ->setIsComplex($data->getIsComplex())->setCity($data->getCity()->getId())
            ->setCost($data->getCost()->getId())->setBuildAge($data->getBuildAge()->getId())
            ->setState($data->getState())->setBuildType($data->getBuildType()->getId())
            ->setArea($data->getArea())->setDiscountCode($data->getDiscountCode());

        $insurance = new InsuranceModel();
        $insuranceId = $insurance->saveOrUpdate($data->getInsurance());

        $property = new PropertyInsuranceModel();
        $propertyId = $property->saveOrUpdate($propertyEntity);

        $result = EarthquickInsurance::where('id', $data->getId())->get();
        if (count($result)) {
            return EarthquickInsurance::where('id', $data->getId())->update($tableData);
        }   
        $tableData['insurance'] = $insuranceId;
        $tableData['property'] = $propertyId;
        return EarthquickInsurance::create($tableData);
    }
}
