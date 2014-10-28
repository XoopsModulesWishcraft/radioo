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

// Include Main Bootstrap File
require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATION . 'mainfile.php';

// Include Pathing
require_once dirname(__FILE__) . DIRECTORY_SEPARATION . 'RadiooPaths.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATION . 'RadiooFunctions.php';


// Load Cryptology Blowfishing Salts
if (is_file(_RADIOO_SECURE_PATH . 'radioo.php'))
	include_once _RADIOO_SECURE_PATH . 'radioo.php';
else {
	xoops_loadLanguage('errors', 'radioo');
	include $GLOBALS['xoops']->path('/header.php');
	echo xoops_error(_RADIOO_ERRORS_MISSINGSALTS_MSG, _RADIOO_ERRORS_MISSINGSALTS_TITLE);
	include $GLOBALS['xoops']->path('/footer.php');
	exit(0);
}
?>