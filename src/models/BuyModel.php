<?php
namespace App\Models;

use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class BuyModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'user', 'insurance', 'price'];

    public function __construct(){
        $this->table = 'buy';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return BuyModel::all();
    }

    public function getById($id) {
        return BuyModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return BuyModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return BuyModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return BuyModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return BuyModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($buy)
    {
        $result = BuyModel::where('id', $buy->getId())->get();
        if (count($result)) {
            return BuyModel::where('id', $buy->getId())->update(['user' => $buy->getUser()->getId(), 'price' => $buy->getPrice(), 'insurance' => $buy->getInsurance()->getId()]);
        }
        $data = [
            'user' => $buy->getUser()->getId(),
            'insurance' => $buy->getInsurance()->getId(),
            'price' => $buy->getPrice()
        ];
        return BuyModel::create($data);
    }
}
