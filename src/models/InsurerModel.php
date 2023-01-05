<?php
namespace App\Models;

use App\Interfaces\Model as modelInterface;
use Illuminate\Database\Eloquent\Model;

class InsurerModel extends BaseModel implements modelInterface{

    protected $fillable = ['id', 'name', 'active', 'description'];

    public function __construct(){
        $this->table = 'insurer';
        $this->primaryKey = 'id';
        Model::preventsSilentlyDiscardingAttributes(true);
    }

    public function getAll() {
        return InsurerModel::all();
    }

    //accessor
    public function getDescriptionAttribute($value)
    {
        return html_entity_decode($value);
    }

    public function getById($id) {
        return InsurerModel::where('id', '=', $id)->get();
    }

    public function getByFieldName($fieldName, $value)
    {
        return InsurerModel::where($fieldName, '=', $value)->get();
    }

    public function getByIds($ids)
    {
        return InsurerModel::where('id', $ids)->get();
    }

    public function deleteById($id)
    {
        return InsurerModel::where('id', $id)->delete();
    }

    public function deleteByIds($ids)
    {
        return InsurerModel::where('id', $ids)->delete();
    }

    public function saveOrUpdate($insurer)
    {
        $result = InsurerModel::where('id', $insurer->getId())->get();
        if (count($result)) {
            return InsurerModel::where('id', $insurer->getId())->update(['description' => $insurer->getDescription(), 'name' => $insurer->getName(), 'active' => $insurer->getActive()]);
        }
        $data = [
            'description' => $insurer->getDescription(),
            'active' => $insurer->getActive(),
            'name' => $insurer->getName()
        ];
        return InsurerModel::create($data);
    }
}
