<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "goods_img".
 *
 * @property integer $id
 * @property integer $goods_id
 * @property string $img
 */
class Goods_Img extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id'], 'integer'],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => '商品ID',
            'img' => '商品图片',
        ];
    }
    public function getParent(){
        return $this->hasOne(Goods::className(),['id'=>'goods_id']);
    }
}
