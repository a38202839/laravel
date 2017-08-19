<?php
//公共代码区，访问成功或失败，跳转
namespace Core;
class Controller{
	protected $view;
	public function __construct(){
		$this->view =new View();
	}
	protected function success($msg,$url,$time =1){
         header("refresh:{$time};url = 'index.php?{$url}'");
         die($msg);
	}
	protected function error($msg,$url,$time =3){
         header("refresh:{$time};url = 'index.php?{$url}'");
         die($msg);
	}

}