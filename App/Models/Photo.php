<?php

namespace App\Models;

use App\Db;
use App\Model;

class Photo extends Model
{
    const TABLE = 'photos';
    const IMG_FOLDER = 'templates/img';
    const PREVIEW_FOLDER = 'templates/img/preview';

    public $name;
    public $type;
    public $size;
    public $full_name;
    public $preview_full_name;
    public $user_id;

    /**
     * @param null $tmp_name
     * @param null $type
     * @param null $size
     * @param null $user
     */
    public function __construct($tmp_name = null, $type = null, $size = null, $user = null)
    {
        $this->type = explode('/', $type)[1];
        $this->name = substr(md5(microtime() . rand(0, 1000)), 0, 15);
        $this->full_name = static::IMG_FOLDER . '/' . $this->name . '.' . $this->type;
        $this->preview_full_name = static::PREVIEW_FOLDER . '/' . $this->name . '.' . $this->type;
        $this->size = $size;
        $this->user_id = $user->id;

        if ($tmp_name) {
            $this->moveImg($tmp_name);
            $this->copyImgToPreviewFolder($this->full_name);
            $this->resize($this->preview_full_name);
        }
    }

    /**
     * @param $user_id
     * @return array
     */
    public static function findAllByUserId($user_id): array
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE `user_id` = :user_id ORDER BY `id` DESC';
        return $db->query(
            $sql,
            [
                ':user_id' => $user_id,
            ],
            static::class
        );
    }

    /**
     * @param $tmp_name
     */
    protected function moveImg($tmp_name)
    {
        $from = $tmp_name;
        $to = $this->full_name;
        move_uploaded_file($from, $to);
    }

    /**
     * @param $from
     */
    protected function copyImgToPreviewFolder($from)
    {
        copy($from, $this->preview_full_name);
    }

    public static function delete($id)
    {
        $photo = static::findById($id);
        unlink($photo->full_name);
        unlink($photo->preview_full_name);
        parent::delete($id);
    }

    /**
     * @param $image
     * @return mixed|void
     */
    protected function resize($image)
    {
        list($width, $height, $type) = getimagesize($image);
        $types = ['', 'gif', 'jpeg', 'png'];
        if ($type > 3) {
            return;
        }
        $type = $types[$type];
        $func = 'imagecreatefrom' . $type;
        $imageDescriptor = $func($image);
        $newWidth = 0;
        $newHeight = 0;
        $biggerSide = $this->getBiggerSide($image);
        if ('width' === $biggerSide) {
            $newWidth = 100;
            $newHeight = 100 * ($height / $width);
        } elseif ('height' === $biggerSide) {
            $newHeight = 100;
            $newWidth = 100 * ($width / $height);
        }
        $newImageDescriptor = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled(
            $newImageDescriptor, $imageDescriptor,
            0, 0, 0, 0,
            $newWidth, $newHeight,
            $width, $height
        );
        $funcSave = 'image' . $type;
        return $funcSave($newImageDescriptor, $image);

    }

    /**
     * @param $image
     * @return string
     */
    protected function getBiggerSide($image)
    {
        list($width, $height, $type) = getimagesize($image);
        return ($width > $height) ? 'width' : 'height';

    }
}