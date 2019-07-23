<?php


namespace app\models\entity;


use yii\db\ActiveRecord;

/**
 * Class DirEntity
 * @package app\models\entity
 *
 * @property string $name
 * @property string $size
 * @property string $extension
 * @property integer $date
 *
 */
class DirEntity extends ActiveRecord
{

    public static function create(string $name, string $size, string $ext, $date): DirEntity
    {
        $model = new static();
        $model->name = $name;
        $model->size = $size;
        $model->extension = $ext;
        $model->date = $date;
        return $model;

    }




    ####

    public static function tableName()
    {
        return 'dir';
    }
}