<?php
include_once("model/Article.php");

class Model {

	public function getList($data = null)
	{
		$db = Db::getInstance();
		$query = $this->_getQuery($data);
		$req = $db->query($query);
		foreach($req->fetchAll() as $article) {
			$list[] = new Article($article['id'], $article['title'], $article['description'], $article['created'], $article['modified'], $article['mainimage']);
		}
		return $list;
		// here goes some hardcoded values to simulate the database
//		return array(
//			 new Article(1,"Первая статья", "123123", "123123"),
//			 new Article(2, "Вторая статья", "123123", ""),
//			 new Article(3, "Третья статья", "1231244", "")
//		);
	}
	// $data = array('table'=>'articles', 'where'=>array('id >'=>'0', 'title != '=> ' ', 'created >'=>'2016-04-20'), 'order'=>array('created'=>'DESC'), 'limit'=>'1')
	private function _getQuery($data)
	{
		$action = '  SELECT * FROM  ';
		$where = ' WHERE id !=0  ';
		$order = ' ';
		$limit = ' ';
		if (!empty($data['action'])){
			$action = $data['action'];
		} else {
			$action = '  SELECT * FROM  ';
		}
		if (!empty($data['where'])){
			if(is_array($data['where'])){
				foreach($data['where'] as $key=>$search){
					$where .= ' AND '. $key .' "'. $search.'" ';
				}
			} else {
				$where .= ' AND '. $data['where'];
			}
		}
		if (!empty($data['order'])){
			if(is_array($data['order'])){
				foreach($data['order'] as $keysort=>$paramsort){
					$order .= !empty($order) ? ',' : ' ORDER BY '. $keysort .' ' . $paramsort;
				}
			} else {
				$order .= ' ORDER BY '. $data['order'];
			}
		}
		if (!empty($data['limit'])){
			$limit .= ' limit '. $data['limit'];
		}
		$query = $action.' '.$data['table'].' '. $where. ' '. $order.' '. $limit;
		return $query;
	}

	public function getItem($data)
	{
		if(!empty($data['id'])){
			$db = Db::getInstance();
			$req = $db->query('SELECT * FROM articles WHERE id = '.$data['id']);
			foreach($req->fetchAll() as $article) {
				return $article;
			}
		}
	}

	public function saveItem($data)
	{
		if(!empty($data['id'])){
			$mainimage = '';
			if(!empty($_FILES['mainimage']['name'])){
				if ($_FILES['mainimage']['size'] > 1000000) {
					throw new RuntimeException('Exceeded filesize limit.');
				}
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				if (false === $ext = array_search(
						$finfo->file($_FILES['mainimage']['tmp_name']),
						array(
							'jpg' => 'image/jpeg',
							'png' => 'image/png',
							'gif' => 'image/gif',
						),
						true
					)) {
					throw new RuntimeException('Invalid file format.');
				}

				$mainimage = sha1_file($_FILES['mainimage']['tmp_name']).'.'.$ext;
				if (!move_uploaded_file(
					$_FILES['mainimage']['tmp_name'],'images/'.$mainimage)) {
					throw new RuntimeException('Failed to move uploaded file.');
				}
			}
			$modified = date("Y-m-d H:i:s");
			$db = Db::getInstance();
			$set = ' modified = :modified ';
			if(!empty($data['title'])) {
				$set .= ',title = :title';
			}

			if(!empty($data['description'])) {
				$set .= ', description = :description';
			}


			if(!empty($mainimage)){
				$set .= ', mainimage = :mainimage';
			}

			$sql = 'UPDATE articles SET '.$set.'  WHERE id = :id';

			$stmt = $db->prepare($sql);

			if(!empty($data['title'])) {
				$stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
			}

			if(!empty($data['description'])) {
				$stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
			}

			$stmt->bindParam(':modified', $modified);

			if(!empty($mainimage)){
				$stmt->bindParam(':mainimage', $mainimage);
			}

			$stmt->bindParam(':id', $data['id']);

			$stmt->execute();

		} else {
			if(!empty($_FILES['mainimage']['name'])){
				if ($_FILES['mainimage']['size'] > 1000000) {
					throw new RuntimeException('Exceeded filesize limit.');
				}
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				if (false === $ext = array_search(
						$finfo->file($_FILES['mainimage']['tmp_name']),
						array(
							'jpg' => 'image/jpeg',
							'png' => 'image/png',
							'gif' => 'image/gif',
						),
						true
					)) {
					throw new RuntimeException('Invalid file format.');
				}

				$mainimage = sha1_file($_FILES['mainimage']['tmp_name']).'.'.$ext;
				if (!move_uploaded_file(
					$_FILES['mainimage']['tmp_name'],'images/'.$mainimage)) {
					throw new RuntimeException('Failed to move uploaded file.');
				}
			}
			$created = date("Y-m-d H:i:s");
			$db = Db::getInstance();
			$sql = "INSERT INTO articles (title, description, created, mainimage) VALUES (:title,:description, :created, :mainimage );";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
			$stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
			$stmt->bindParam(':created', $created);
			$stmt->bindParam(':mainimage', $mainimage);
			$stmt->execute();

		}
		header('Location: /');
	}

	public function delItem($data)
	{
		if(!empty($data['id'])){
			$db = Db::getInstance();
			$req = $db->query('SELECT * FROM articles WHERE id = '.$data['id']);
			foreach($req->fetchAll() as $article) {
				if(!empty($article['mainimage'])){
					unlink('images/'.$article['mainimage']);
				}
			}
			$db->query('DELETE  FROM articles WHERE id = '.$data['id']);
		}
		header('Location: /');
	}

	
}

?>