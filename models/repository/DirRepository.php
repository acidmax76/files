<?php


namespace app\models\repository;


use app\models\entity\DirEntity;
use Exception;
use yii\db\ActiveQuery;

/**
 * Class DirRepository
 * @package app\models\repository
 *
 * @property DirEntity $entity
 */
class DirRepository
{

    public function getAll(): ActiveQuery
    {
        $query = DirEntity::find();
        return $query;
    }

    public function save(DirEntity $model): void
    {
        if (!$model->save()) {
            throw  new Exception('Can not save model !');
        }
    }

    public function deleteAll()
    {
        try {
            $records = DirEntity::deleteAll();
        } catch (Exception $e) {
            throw new Exception('Can not delete records');
        }
    }
}