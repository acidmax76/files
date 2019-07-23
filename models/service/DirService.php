<?php


namespace app\models\service;


use app\models\entity\DirEntity;
use app\models\repository\DirRepository;
use app\models\repository\FileRepository;
use Exception;
use yii\data\ArrayDataProvider;

/**
 * Class DirService
 * @package app\models\service
 */
class DirService
{
    /**
     * @var FileRepository
     */
    private $file_repo;
    /**
     * @var DirRepository
     */
    private $dir_repo;
    /**
     * @var string
     */
    private $dir;

    /**
     * DirService constructor.
     * @param DirRepository $dir_repo
     * @param FileRepository $file_repo
     */
    public function __construct(DirRepository $dir_repo, FileRepository $file_repo)
    {
        $this->dir_repo = $dir_repo;
        $this->file_repo = $file_repo;
    }

    /**
     * @param string $dir
     * @return ArrayDataProvider
     * @throws Exception
     */
    public function show(string $dir)
    {
        $this->dir = $dir;
        $query = $this->dir_repo->getAll();
        $models = $query->asArray()->all();
        if (empty($models)) {
            $models = $this->update();
        }
        return $this->configureProvider($models);
    }

    /**
     * @param string $dir
     * @return ArrayDataProvider
     * @throws Exception
     */
    public function refresh(string $dir): ArrayDataProvider
    {
        $this->dir = $dir;
        $this->dir_repo->deleteAll();
        $models = $this->update();
        return $this->configureProvider($models);
    }

    /**
     * @return array
     * @throws Exception
     */
    private function update(): array
    {
        if (!file_exists($this->dir)) {
            throw new Exception('Dir ' . $this->dir . ' does not exist');
        }
        if (!is_dir($this->dir)) {
            throw new Exception('The ' . $this->dir . ' not a directory');
        }
        $models = $this->file_repo->readDir($this->dir);
        foreach ($models as $model) {
            $entity = DirEntity::create($model['name'], $model['size'], $model['extension'], $model['date']);
            $this->dir_repo->save($entity);
        }
        return $models;
    }


    /**
     * @param array $models
     * @return ArrayDataProvider
     */
    private function configureProvider(array $models): ArrayDataProvider
    {
        $dataProvider = new ArrayDataProvider();
        $dataProvider->pagination = false;
        $dataProvider->setModels($models);
        return $dataProvider;
    }


}