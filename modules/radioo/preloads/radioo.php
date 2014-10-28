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


/**
 * 
 */
include_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'RadiooPaths.php';

/**
 * 
 * @author sire
 *
 */		
class RadiooRadiooPreload extends XoopsPreloadItem
{
    /**
     * @param $args
     */
    function eventCoreHeaderCheckcache($args)
    {
    	if (isset($_SESSION['radioo']['active']) && $_SESSION['radioo']['active'] == true) {
    		if (is_object($GLOBALS['xoTheme']))
    		{
    			$GLOBALS['xoTheme']->addStylesheet(_RADIOO_RES_URL . 'language/' . $GLOBALS['xoopsConfig']['language'] . '/style.css', array('type' => 'text/css'), '', md5(_RADIOO_CSS_URL . 'style.css'));
    			$GLOBALS['xoTheme']->addStylesheet(_RADIOO_CSS_URL . 'style.css', array('type' => 'text/css'), '', md5(_RADIOO_CSS_URL . 'style.css'));
    			$GLOBALS['xoTheme']->addStylesheet(_RADIOO_CSS_URL . 'fonts.css', array('type' => 'text/css'), '', md5(_RADIOO_CSS_URL . 'fonts.css'));
    			$GLOBALS['xoTheme']->addStylesheet(_RADIOO_CSS_URL . 'jplayer.css', array('type' => 'text/css'), '', md5(_RADIOO_CSS_URL . 'jplayer.css'));
    			$GLOBALS['xoTheme']->addScript(XOOPS_URL . 'browse.php?Frameworks/jquery/jquery.js');
    			$GLOBALS['xoTheme']->addScript(_RADIOO_JS_URL . 'jquery.jplayer.min.js');
    			$GLOBALS['xoTheme']->addScript('', array('type'=>"text/javascript"), '$(document).ready(function(){
		$("#randomradio").jPlayer({
			ready: function () {
				$(this).jPlayer("setMedia", {
					' . $_SESSION['radioo']['format'] .': "' . $_SESSION['radioo']['uri'] .'"
				}).jPlayer("play");
			},
		 	ended: function() { 
			 	$(this).jPlayer("play"); 
			},
			swfPath: "' . _RADIOO_SWF_URL. 'Jplayer.swf",
			supplied: "' . $_SESSION['radioo']['format'] . '",
			wmode: "window",
			smoothPlayBar: true,
			keyEnabled: true,
			remainingDuration: false,
			toggleDuration: false
		});
	});', md5(microtime().dirname(__FILE__)));
    		}
    	}   
    	
    	if (isset($_SESSION['radioo']['active']) && $_SESSION['radioo']['active'] == true && $_SESSION['radioo']['smarty']['display'] == 'smarty') {
    		$GLOBALS['xoopsTpl']->assign($_SESSION['radioo']['smarty']['tag'], $GLOBALS['xoopsTpl']->fetch(_RADIOO_TEMPLATE_PATH . 'radioo_jplayer.html', null, null, false));
    	}   
    }

    
    /**
     * @param $args
     */
    function eventCoreFooterEnd($args)
    {
    	if (isset($_SESSION['radioo']['active']) && $_SESSION['radioo']['active'] == true && $_SESSION['radioo']['broadcast']['display'] == 'none') {
    		print $GLOBALS['xoopsTpl']->render('db:radioo_jplayer.html');
    	}
    }
    
    /**
     * @param $args
     */
    function eventCoreIncludeCommonEnd($args)
    {

    }
   
}
