<?php
namespace App\Models;

use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'value'];

    public function __construct(){
        $this->table = 'paymenttype';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return PaymentModel::all();
    }

    public function getById($id) {
        return PaymentModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return PaymentModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return PaymentModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return PaymentModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return PaymentModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($data)
    {
        return PaymentModel::updateOrInsert(
            ['id' => $data->getId()], ['value' => $data->getValue()]
        );
    }
}
