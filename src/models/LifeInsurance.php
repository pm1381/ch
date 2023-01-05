<?php
namespace App\Models;

use App\Entities\LifeInsurance;
use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class LifeInsuranceModel extends BaseModel implements modelInterface{

    protected $fillable = ['paymentType', 'minimumMonthlyPay', 'increasePercent', 'duration', 'minimumAge', 'increaseFund', 'medicalCost', 'deathFund', 'insurance'];
    public function __construct(){
        $this->table = 'lifeinsurance';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return LifeInsuranceModel::all();
    }

    public function getById($id) {
        return LifeInsuranceModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return LifeInsuranceModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return LifeInsuranceModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return LifeInsuranceModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return LifeInsuranceModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($data)
    {
        $tableData = [
            'deathFund' => $data->getDeathFund(),
            'redemption' => $data->getRedemption(),
            'medicalCost' => $data->getMedicalCost(),
            'increaseFund' => $data->getIncreaseFund(),
            'minimumAge' => $data->getMinimumAge(),
            'duration' => $data->getDuration(),
            'increasePercent' => $data->getIncreasePercent(),
            'minimumMonthlyPay' => $data->getMinimumMonthlyPay(),
            'paymentType' => $data->getPayment()->getId()
        ];

        $insurance = new InsuranceModel();
        $insuranceId = $insurance->saveOrUpdate($data->getInsurance());

        $result = LifeInsuranceModel::where('id', $data->getId())->get();
        if (count($result)) {
            return LifeInsuranceModel::where('id', $data->getId())->update($tableData);
        }
        $tableData['insurance'] = $insuranceId;
        return LifeInsuranceModel::create($tableData);
    }
}
