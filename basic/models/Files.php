<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $file_name
 * @property string $size
 * @property string $time_create
 * @property string $storage
 * @property integer $user_id
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name', 'time_create', 'storage', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['file_name', 'time_create', 'storage'], 'string', 'max' => 255],
            [['size'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => 'File Name',
            'size' => 'Size',
            'time_create' => 'Time Create',
            'storage' => 'Storage',
            'user_id' => 'User ID',
        ];
    }
}
