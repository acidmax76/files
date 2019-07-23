<?php


namespace app\models\repository;

use app\models\entity\FileEntity;
use Exception;

/**
 * Class FileRepository
 * @package app\models\repository
 */
class FileRepository
{
    /**
     * @var array
     */
    private $items_of_dir = [];

    /**
     * @param string $dir
     * @return array
     * @throws Exception
     */
    public function readDir(string $dir): array
    {
        try {
            $this->items_of_dir = scandir($dir);
            $this->parse($dir);
            return $this->items_of_dir;
        } catch (Exception $e) {
            throw new Exception('Error in dir ' . $e->getMessage());
        }
    }

    /**
     * @param string $dir
     */
    private function parse(string $dir): void
    {
        $result = [];
        foreach ($this->items_of_dir as $item) {
            if ($item != '.' && $item != '..') {
                $model = FileEntity::getInfo($dir . '/', $item);
                $result [] = [
                    'name' => $model->name,
                    'size' => $model->size,
                    'extension' => $model->extension,
                    'date' => $model->date,
                ];
            }
        }
        $this->items_of_dir = $result;
    }

}