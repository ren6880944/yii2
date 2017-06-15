<?php
namespace backend\models;

use yii\base\Model;
use yii\db\ActiveQuery;

class GoodsSearchForm extends Model{
    public $name;
    public $sn;
    public $min_price;
    public $max_price;

    public function rules()
    {
        return [
            ['name','string','max'=>20],
            ['sn','integer'],
            [['min_price','max_price'],'double']
        ];
    }
    public function search(ActiveQuery $query){
        $this->load(\Yii::$app->request->get());
        if($this->name){
            $query->andWhere(['like','name',$this->name]);
        }
        if($this->sn){
            $query->andWhere(['like','sn',$this->sn]);
        }
        if($this->max_price){
            $query->andWhere(['<=','shop_price',$this->max_price]);
        }
        if($this->min_price){
            $query->andWhere(['>=','shop_price',$this->min_price]);
        }

    }

}