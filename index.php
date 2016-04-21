<?php 
	include_once("helpers/Helper.php");
	include_once("controller/Controller.php");

	$data = array('table'=>'articles');
	$action = 'getList';
	$view = 'List';
	$model = 'Model';

	if(!empty($_POST)) {
	}
	if(!empty($_GET)) {
		$view = $_GET['view'];
		if(!empty($_GET['id'])){
			$data = $_GET;
			$action = 'getItem';
		}
	}

	if(isset($_POST['save'])) {
		$data = $_POST;
		$action = 'saveItem';
	}

	if(isset($_POST['delete'])) {
		$data = $_POST;
		$action = 'delItem';
	}


	$controller = new Controller($model, $view);
	$controller->start($data, $action);

?>