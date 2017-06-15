<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $lgo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 */
class Goods extends \yii\db\ActiveRecord
{
//    public $is_on_sale;
    public static $sale=[0=>'下架',1=>'在售'];
//    public $imgFile;
    public static $status=[0=>'回收站',1=>'正常'];
    public $content;
    public $title;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_on_sale','status','goods_category_id','brand_id'],'required'],
            [['goods_category_id', 'brand_id', 'stock', 'sort', ], 'integer'],
            [['market_price', 'shop_price'], 'number'],
            [['name', 'sn'], 'string', 'max' => 20],
            ['logo','string','max'=>255],
//            ['imgFile','file','extensions'=>['jpg','jpeg','png','gif']],
            ['content','string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '货号',
            'imgFile' => 'LOGO图片',
            'goods_category_id' => '商品分类',
            'brand_id' => '品牌分类',
            'market_price' => '市场价格',
            'shop_price' => '商品价格',
            'stock' => '库存',
            'is_on_sale' => '是否在售',
            'status' => '状态',
            'sort' => '排序',
            'create_time' => '添加时间',
            'content'=>'商品描述',
        ];
    }
    public function beforeSave($insert)
    {
        if($insert){
            $this->create_time=time();
        }
        return parent::beforeSave($insert);
    }
    //与商品分类的一对一关系
    public function getParent(){
        return $this->hasOne(Goods_Category::className(),['id'=>'goods_category_id']);
    }
    //与品牌的一对一关系
    public function getBparent(){
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
    //静态调用商品分类的所有选项
    public static function getOptions(){
        return ArrayHelper::map(Goods_Category::find()->asArray()->all(),'id','name');
    }
    //静态调用品牌的所有选项
    public static function getBrand(){
        return ArrayHelper::map(Brand::find()->where(['status'=>1])->asArray()->all(),'id','name');
    }
}
