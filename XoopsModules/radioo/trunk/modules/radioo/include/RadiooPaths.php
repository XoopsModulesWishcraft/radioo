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
 * @since 			1.111
 * @author 			Antony Cipher <cipher@labs.coop>
 * @author 			Simon Roberts <meshy@labs.coop>
 * @subpackage		kernel
 * @description		Chronolabs XOOPS Module for Chat and Walky Talky Services
 * 
 */

	require_once dirname(dirname(dirname(dirname(__DATA__)))) . 'mainfile.php';
	
	// Path to the radioo directory:
	define('_RADIOO_PATH', XOOPS_ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'radioo' . DIRECTORY_SEPARATOR);
	define('_RADIOO_LIB_PATH', XOOPS_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'radioo' . DIRECTORY_SEPARATOR);
	define('_RADIOO_DATA_PATH', XOOPS_VAR_PATH . DIRECTORY_SEPARATOR . 'radioo' . DIRECTORY_SEPARATOR);
	define('_RADIOO_SECURE_PATH', XOOPS_VAR_PATH . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);
	define('_RADIOO_TEMPLATE_PATH', _RADIOO_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
	
	if (!is_dir(_RADIOO_DATA_PATH))
		mkdir(_RADIOO_DATA_PATH, 0777, true);
	
	if (!$GLOBALS['xoopsModuleConfig']['htaccess'])
	{
		define('_RADIOO_URL', XOOPS_URL . '/modules/radioo');
		define('_RADIOO_RES_URL', XOOPS_URL . '/modules/radioo');
	} else {
		define('_RADIOO_URL', XOOPS_URL . '/' . $GLOBALS['xoopsModuleConfig']['htaccess_path']);
		define('_RADIOO_RES_URL', XOOPS_URL . '/modules/radioo');
	}
	
	define('_RADIOO_JS_URL', _RADIOO_RES_URL . '/js');
	define('_RADIOO_CSS_URL', _RADIOO_RES_URL . '/css');
	define('_RADIOO_SWF_URL', _RADIOO_RES_URL . '/flash');
	define('_RADIOO_PLAYER_URL', _RADIOO_URL);
?>