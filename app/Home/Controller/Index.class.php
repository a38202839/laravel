<?php
namespace Home\Controller;

use \Core\Controller;
class Index extends Controller{
	public function index(){
	  // // $view = new \Core\View();
	  // $this->view->assign('id',2);
	  // $this->view->assign('username','王三');
	  // $this->view->assign('age',20);
	  // $this->view->display('user1.html');
	  echo "<h1><a href='#'>:) Index</a>点击</h1>";
	}
}
