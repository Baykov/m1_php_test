<?php

class Controller {
	public $model;
	public $view;
	public $action;
	public $result;
	public $data;

	public function __construct($modelName = 'Model', $viewName = 'List')
    {
		$this->model = $modelName;
		$this->view = $viewName;
    }
	
	public function start($data = array('table'=>'articles'), $action)
	{
		$model = new $this->model();
		$this->data = $data;
		$this->action = $action;
		//var_dump($this->actio);
		$this->result = $model->{ $this->action }($this->data);
		include 'view/head.php';
		include 'view/View'.$this->view.'.php';
		include 'view/footer.php';
	}
}

?>