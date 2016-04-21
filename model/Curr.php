<?php

class Curr extends Model{
	
	public function __construct($params = array()){}
	
	public function start($data)
	{
		$id = $data['id'];
		$db = Db::getInstance();
		$sqlSel = $db->prepare('SELECT stat.*, cur.Name as CurName FROM currensies_stat as stat LEFT JOIN currensies as cur ON cur.NumCode = stat.NumCode WHERE stat.NumCode = ? ORDER BY stat.Date');
		$sqlSel->execute(array($id));

		foreach($sqlSel->fetchAll() as $currency) {
			$list[] = $currency;
		}

		return $list;

	}
	
}

?>