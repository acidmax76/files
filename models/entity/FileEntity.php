<?php


namespace app\models\entity;


class FileEntity
{
    public $name;
    public $size;
    public $extension;
    public $date;

    public static function getInfo(string $dir, string $file): FileEntity
    {
        $model = new static();
        $model->name = $file;
        $model->date = filemtime($dir . $file);
        if (is_dir($dir . $file)) {
            $model->size = 'DIR';
            $model->extension = '';
        } elseif (is_file($dir . $file)) {
            $model->size = filesize($dir . $file);
            $model->extension = pathinfo($dir . $file, PATHINFO_EXTENSION);
        }

        return $model;
    }

}