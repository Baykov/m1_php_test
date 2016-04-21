<?php


class View
{
    protected $name;

    public function __construct($viewlName = 'list')
    {
        $this->name = $viewlName;
    }

    protected function _getName(){
        return $this->name;
    }

    public function _display(){
        include $this->_getName().'.php';
    }
}