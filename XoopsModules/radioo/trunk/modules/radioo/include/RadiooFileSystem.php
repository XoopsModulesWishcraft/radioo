<?php
/*
 * Chronolabs XOOPS Chat Module - xALKY
 * 
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 
 * @copyright 		Chronolabs Cooperative http://labs.coop
 * @license 		General Software Licence (https://web.labs.coop/public/legal/general-software-license/10,3.html)
 * @package 		radioo
 * @since 			1.02
 * @author 			Antony Cipher <cipher@labs.coop>
 * @author 			Simon Roberts <meshy@labs.coop>
 * @subpackage		classes
 * @description		Chronolabs XOOPS Module for Chat and Walky Talky Services
 * 
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');


/**
 * 
 */
if (!class_exists("RadiooFileSystem")) {
	
	/**
	 * Class to provide methods for file system access:
	 * 
	 * @author sire
	 *
	 */ 
	class RadiooFileSystem {
	
		/**
		 * 
		 * @param unknown $file
		 * @return string
		 */
		static function getFileContents($file) {
			if(function_exists('file_get_contents')) {
				return file_get_contents($file);
			} else {
				return(implode('', file($file)));
			}
		}
	
		/**
		 * 
		 * @param string $file
		 * @param string $content
		 * @return unknown
		 */
		static function saveFileContent($file = '', $content = '')
		{
			try
			{
				if (file_exists($file))
					unlink($file);
				
				if (!is_dir(dirname($file)))
					mkdir(dirname($file), 0777, true);
				else
					chmod(dirname($file), 0777);

				$f = fopen($file, 'w');
				fwrite($f, $content, strlen($content));
				fclose($f);
			}
			catch (Exception $e)
			{
				return false;
			}
			return true;
		}
	}
}
?>