<?php

/**
 * Created by PhpStorm.
 * User: 12
 * Date: 21.04.2016
 * Time: 11:34
 */
class Article
{
    public $id;
    public $title;
    public $description;
    public $created;
    public $modified;
    public $mainimage;
    public function __construct($id, $title ='', $description ='', $created = '', $modified='', $mainimage = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->created = $created;
        $this->modified = $modified;
        $this->mainimage = $mainimage;
    }


}