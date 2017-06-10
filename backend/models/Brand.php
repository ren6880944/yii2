<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
//    public $imgFile;
    public static $optionlist=[0=>'隐藏',1=>'正常'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','sort', 'status','intro'], 'required'],
            [['intro'], 'string'],
            [['sort'], 'integer'],
            [['logo'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
//            [['imgFile'], 'file', 'extensions'=>['jpg','jpeg','png','gif']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'logo' => '上传Logo',
            'sort' => '排序',
            'status' => '状态',
        ];
    }
}