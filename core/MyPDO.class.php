<?php
namespace Core;
use \PDO;
use \PDOException;

class  MyPDO{
	private $type;
	private $host;
	private $port;
	private $user;
	private $pass;
	private $dbname;
	private $charset;
	public function __construct($pdoinfo=array()){
         global $config;
      $this->type = isset($pdoinfo['type']) ? $pdoinfo['type'] : $config['type'];
      $this->host = isset($pdoinfo['host']) ? $pdoinfo['host'] : $config[$this->type]['host'];
      $this->port = isset($pdoinfo['port']) ? $pdoinfo['port'] : $config[$this->port]['port'];
      $this->user = isset($pdoinfo['user']) ? $pdoinfo['user'] : $config[$this->user]['user'];
      $this->passo = isset($pdoinfo['pass']) ? $pdoinfo['pass'] : $config[$this->pass]['pass'];
      $this->dbname = isset($pdoinfo['dbname']) ? $pdoinfo['dbname'] : $config[$this->dbname]['dbname'];
 $this->charset = isset($pdoinfo['charset']) ? $pdoinfo['charset'] : $config[$this->charset]['charset'];   
       //利用PDO建立连接：异常处理
       try{
       	$this->pdo = new PDO("{$this->type}:host={$this->host};port={$this->port};dbname={$this->dbnaem};charset={$this->charset}",$this->user,$this->pass);
       	$this->pdo->setAttribute(PDO:ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       }catch(PDOException $e){
       	 echo 'PDO初始化数据库连接失败！<br />';
       	 echo '失败文件为：' . $e->getFile() . '<br />';
       	 echo '失败行为：' . $e->getLine() . '<br />';
       	 echo '失败原因为：' . $e->getMessage() . '<br />';
       	 exit;
       }

	}
	public function db_exec($sql){
		try{
			return $this->pdo->exec($sql);
		}catch(PDOException $e){
		 echo 'SQL执行失败！<br />';
       	 echo '失败sql指令为：' . $sql . '<br />';
       	 echo '失败行为：' . $e->getLine() . '<br />';
       	 echo '失败原因为：' . $e->getMessage() . '<br />';
       	 exit;
		}
	}
	public function db_insertID(){
		return $this->pdo->lastInsertID();
	}
	public function db_getOne($sql){
		return $this->db_query($sql);
	}
	public function db_getAll($sql){
		return $this->db_query($sql,true);
	}
	private function db_query($sql,$all = false){
		try{
			$stmt = $this->pdo->query($sql);
			return $all ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
		 echo 'SQL执行失败！<br />';
       	 echo '失败sql指令为：' . $sql . '<br />';
       	 echo '失败行为：' . $e->getLine() . '<br />';
       	 echo '失败原因为：' . $e->getMessage() . '<br />';
       	 exit;
		}
	}
}