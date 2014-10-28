<?php
/*
 * Chronolabs XOOPS Life Streaming Radio Module - Radioo
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
 * @subpackage		language
 * @description		Chronolabs XOOPS Module for Chat and Walky Talky Services
 * 
 */


defined('XOOPS_ROOT_PATH') or die('Restricted access');

 
define('_RADIOO_ERRORS_MISSINGSALTS_MSG', 'There seems to be a problem with your installation of "RADIOO" the XOOPS module, for some reason the secure file which contains your salts for your encryption systems with this have or are corrupt or missing, you will need to uninstall the module and reinstall it in: Xoops version:~ '. XOOPS_VERSION);
define('_RADIOO_ERRORS_MISSINGSALTS_TITLE', 'Critical data missing, you will have to reinstall this module!');
?>