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


// Include Pathing
require_once dirname(__FILE__) . DIRECTORY_SEPARATION . 'RadiooPaths.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATION . 'RadiooFunctions.php';

/**
 * 
 * @param unknown $module
 * @param string $oldversion
 * @return boolean
 */
function xoops_module_update_profile(&$module, $oldversion = null)
{
    
    return true;
}
