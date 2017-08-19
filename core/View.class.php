<?php
namespace Core;

class View{
	// private $data =array();
	private $smarty;
	public function __construct(){
		include_once VENDOR_DIR.'Smarty/Smarty.class.php';
		$this->smarty = new \Smarty();

		$this->smarty->setTemplateDir(APP_DIR.PLAT.'/View/');
		//设置编译文件的路径
		$this->smarty->setCompileDir(APP_DIR.PLAT.'/View_c/');
	}
	public function assign($name,$value){
        $this->smarty->assign($name,$value);
	}
	public function display($tpl){
		$this->smarty->display($tpl);
		}
       // echo $string;
	}
	
