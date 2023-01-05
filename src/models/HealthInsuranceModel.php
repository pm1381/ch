<?php
namespace App\Models;

use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class HealthInsuranceModel extends BaseModel implements modelInterface{

    protected $fillable = ['personCount', 'description', 'pregnancyTime', 'insurance ', 'type', 'stars', 'name', 'discountCode', 'patientGetPercantage', 'chronicTime'];
    public function __construct(){
        $this->table = 'healthinsurance';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return HealthInsuranceModel::all();
    }

    public function getById($id) {
        return HealthInsuranceModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return HealthInsuranceModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return HealthInsuranceModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return HealthInsuranceModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return HealthInsuranceModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($data)
    {
        $tableData = [
            'type' => $data->getType(),
            'stars' => $data->getStars(),
            'pregnancyTime' => $data->getPregnancyTime(),
            'chronicTime' => $data->getChronicTime(),
            'patientGetPercantage' => $data->getPatientGetPercantage(),
            'discountCode' => $data->getDiscountCode(),
            'name' => $data->getName(),
            'description' => $data->getDescription(),
            'personCount' => $data->getPersonCount()
        ];
        $insurance = new InsuranceModel();
        $insuranceId = $insurance->saveOrUpdate($data->getInsurance());

        $result = HealthInsuranceModel::where('id', $data->getId())->get();
        if (count($result)) {
            return HealthInsuranceModel::where('id', $data->getId())->update($tableData);
        }
        $tableData['insurance'] = $insuranceId;
        return HealthInsuranceModel::create($tableData);
    }
}

