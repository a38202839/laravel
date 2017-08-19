<?php
//命名空间
namespace Core;

if(!defined('ACCESS')) header('location:../index1.php');

class App{
	//设置字符集
	private static function initCharset(){
		header("Content-type:text/html;Charset=utf-8");
	}
	//定义目录常量
	private static function initDirConst(){
		define('ROOT_DIR',str_replace('core','', str_replace('\\', '/', __DIR__)));
		define('CORE_DIR',ROOT_DIR.'core/');
		define('APP_DIR',ROOT_DIR.'app/');
		define('CONFIG_DIR',ROOT_DIR.'config/');
		define('PUBLIC_DIR',ROOT_DIR.'public/');
		define('VENDOR_DIR',ROOT_DIR.'vendor/');
		define('UPLOAD_DIR',ROOT_DIR.'upload/');
	}
	//设定系统控制
	private static function initSystem(){
		@ini_set('error_reporting',E_ALL);//错误级别
		@ini_set('display_error', 1);//是否显示错误
	}
	//设定配置文件
	private static function initConfig(){
		//加载配置文件
		global $config;//定义全局变量
		$config = include_once CONFIG_DIR . 'config.php';
	}
	//初始化URL：从URL中获取三个数据：平台，控制器，方法
	private static function initURL(){
		$plat = isset($_REQUEST['p']) ? $_REQUEST['p'] : 'Home';
		$module = isset($_REQUEST['m']) ? $_REQUEST['m'] : 'Index';
		$action = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index';
		define('PLAT', $plat);

		define('MODULE', $module);
		define('ACTION',$action);
	}
	//设定自动加载
	   private static function initAutoload(){
		spl_autoload_register(array(__CLASS__,'loadCore'));
		spl_autoload_register(array(__CLASS__,'loadController'));
		spl_autoload_register(array(__CLASS__,'loadModel'));
		spl_autoload_register(array(__CLASS__,'loadVendor'));
	}
	//增加多个方法，加载不同文件夹的类
	   private static function loadCore($clsname){
		$file = CORE_DIR .basename($clsname) . '.class.php';
		if(is_file($file)){
			include_once $file;
		}
	}
		private static function loadVendor($clsname){
		$file = VENDOR_DIR .basename($clsname) . '.class.php';
		if(is_file($file)){
			include_once $file;
		  }
	   }
		private static function loadController($clsname){
		$file = APP_DIR .PLAT .'/controller/'.basename($clsname) .'.class.php';
		if(is_file($file)){
			include_once $file;
		}
	 }
		private static function loadModel($clsname){
		$file = APP_DIR.'model/' .basename($clsname) . '.class.php';
		if(is_file($file)){
			include_once $file;
		}
	}
	//分发控制器
	private static function initDispatch(){
		$action = ACTION;
		$module = "\\".PLAT."\\Controller\\".MODULE;
		$m = new $module();
		$m->$action();
	}
	//运行方法
	public static function run(){
		self::initCharset();
		self::initDirConst();
		self::initSystem();
		self::initConfig();
		self::initURL();
		self::initAutoload();
		self::initDispatch();
	}
}
