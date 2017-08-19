<?php
 class Upload{
 	private static $image_type = array('imafe/jpeg','image/jpg','image/gif','image/png');
    public static $error = '';
 	public static function uploadImage($file,$path){
 		//文件判断
 		if(!is_array($file) || !isset($file['error'])){
 			self::$error = '错误操作！';
 			return false;
 		}
 		//文件类型判断
 		if(!in_array($file['type'],self::$image_type)){
 			self::$error = '当前文件类型不允许';
 			return false;
 		}
 		//判断文件是否上传成功
 		switch($file['error']){
            case 1:
                self::$error = '文件过大';
                return false;
            case 2:
                self::$error = '文件过大';
                return false;
            case 3:
                self::$error = '文件上传部分成功';
                return false;
            case 4:
                self::$error = '没有选中文件';
                return false;
            // case 5:
            //     self::$error = '文件过大';
            //     return false;
            case 6:
                self::$error = '临时文件夹不存在';
                return false;
            case 7:
                self::$error = '文件上传失败';
                    return false;
            }
            //获得新名字后缀
             $new_name = self::getNewName($file['name']);
             if(move_uploaded_file($file['tmp_name', $path . '/' . $new_name)){
             	return $new_name;
             }else{
             	self::$error = '文件上传到指定文件夹失败';
             	return false;
             }
 		}
 		//获取新名字
 		private static function getNewName($filename){
 			$newname = date('YmdHis');
 			$arr = array_merge(range('a','z'),range('A','Z'));
 			shuffle($arr);
 			$newname .= $arr[0] . $arr[1] . $arr[2] . $arr[3];
 			$newname .= '.' . strrchr($filename, '.');
 			return $newname;
 		}
 	}
 }