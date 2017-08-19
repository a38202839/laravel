<?php
//公共代码区，连接数据库，增，删，改
namespace Model;
use \Core\MyPDO;
class Model{
	protected $dao;
	public function __construct(){
		$this->dao = new MyPDO();
		// mysql_connect('localhost:3306;','root','root');
		// mysql_query('set names utf8');
		// mysql_query('use bbs');
	}
	protected funtion getDataByID($id){
        $sql = "select * from {$this->table} where id = {$id}";
       return $this->dao->db_getOne($sql);
	}
}