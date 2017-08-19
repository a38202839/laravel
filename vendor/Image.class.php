<?php
class Image{
	private static $type = array(1=>'gif',2=>'jpeg',3=>'png');
	private static $error = '';
	public  static function thumbImage($file,$path,$width=80,$height = 100){
		if(!file_exists($file)){
			self::$error = '原文件不存在';
			return false;
		}
		list($src_width,$src_height,$type) = getimagesize($file);
		if($type !=1 && $type !=2 && $type != 3){
			self::$error = '当前文件不能做缩略图';
			return false;
		}
		$open = 'imagecreatefrom' . self::$type[$type];
		$save = 'image' . self::$type[$type];
		$image_src=$open($file);
		$image_dst = imagecreatetruecolor($width, $height);

		if(!imagecopyresampled($image_dst, $image_src,0,0, 0, 0, $width, $height, $src_width, $src_height)){
               self::$error = '采样复制出错';
               return false;
           }

           $thumb_name = 'thumb_' . basename($file);
           if(!$save($image_dst,$path . '/' . $thumb_name)){
           	self::$error = '缩略图保存失败';
           	return false;
           }
           imagedestroy($image_src);
           imagedestroy($image_dst);

           return $thumb_name;

	 } 
}