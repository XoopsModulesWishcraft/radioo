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
 * @subpackage		classes
 * @description		Chronolabs XOOPS Module for Chat and Walky Talky Services
 * 
 */
defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * Library Dependencies
 */
include_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'RadiooFileSystem.php';
include_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'RadiooCrypt.php';
include_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'RadiooXMLArray.php';
include_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'RadiooXMLWrapper.php';


class RadiooStore extends XoopsObject
{

	/**
	 *
	 * @var unknown
	 */
	var $_root = 'RadiooDataStore';
	
	/**
	 * 
	 * @var array
	 */ 
	var $__data = array();

	/**
	 *
	 * @var unknown
	 */
	var $_method = '';
	
	/**
	 *
	 * @var unknown
	 */
	var $_extensions = array();
	
	/**
	 * 
	 * @param unknown $method
	 */
	function __construct()
	{
		$this->_method = (!definef('_RADIOO_IO_STORE_METHOD')?'json':constant("_RADIOO_IO_STORE_METHOD"));
		$this->_extensions = RadiooIOHandler::getFileSuffix();
		
		// File store database headers
		$this->initVar('id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('created', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('saved', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('read', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('dropped', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('deleted', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('bytes_data', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('bytes_store', XOBJ_DTYPE_INT, 0, true);
		$this->initVar('md5_data', XOBJ_DTYPE_OTHER, '', true, 32);
		$this->initVar('md5_store', XOBJ_DTYPE_OTHER, '', true, 32);
		$this->initVar('method', XOBJ_DTYPE_ENUM, (!definef('_RADIOO_DATA_STORE_METHOD')?'json':constant("_RADIOO_DATA_STORE_METHOD")), true, false, false, array('json', 'xml', 'serial'));
		$this->initVar('filename', XOBJ_DTYPE_OTHER, '', true, 128);
		$this->initVar('path', XOBJ_DTYPE_OTHER, '', true, 255);
		$this->initVar('token', XOBJ_DTYPE_OTHER, '', true, 44);
		$this->initVar('salt', XOBJ_DTYPE_OTHER, substr(sha1(microtime(true).XOOPS_ROOT_PATH.XOOPS_DB_PASS.XOOPS_DB_NAME.XOOPS_DB_UNAME.$_SERVER['REMOTE_ADDR']), mt_rand(0, 31), 11), true, 11);
	}
 
	/**
	 * (non-PHPdoc)
	 * @see XoopsObject::setVar()
	 */
	public function setVar($key, $value, $not_gpc)
	{
		if ($key == 'salt')
			return false;
		elseif ($key == 'method')
			$this->_method = $value;
		return parent::setVar($key, $value, $not_gpc);		
	}

	/**
	 * (non-PHPdoc)
	 * @see XoopsObject::assignVar()
	 */
	public function assignVar($key, $value, $not_gpc)
	{
		if ($key == 'method')
			$this->_method = $value;
		return parent::assignVar($key, $value, $not_gpc);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see XoopsObject::assignVar()
	 */
	public function assignVars($var_array = array())
	{
		foreach($var_array as $key => $value)
		{
			$this->assignVar($key, $value);
		}
		$this->load();
	}

	/**
	 * 
	 * @return boolean
	 */
	public function hasCryptingSalt()
	{
		if (strlen($this->getVar('salt')) != 0 && defined('_RADIOO_CRYPT_SALT'))
			return true;
		return false;
	}

	/**
	 *
	 * @return boolean
	 */
	public function getCryptingSalt()
	{
		if (!$this->hasCryptingSalt())
			return false;
		return md5($this->getVar('salt') . _RADIOO_CRYPT_SALT);
	}
	
	 /**
	  *
	  * @param string $this->getVar('path')
	  * @param string $this->getVar('filename')
	  * @return multitype:
	  */
	 public function save()
	 {
	 	if (!in_array($this->getVar('method'), array_keys(RadiooIOHandler::getMethods()))||strlen($this->getVar('method'))==0)
	 		$this->setVar('method', $this->_method);
	 	$data = $this->parse($this->__data, $this->_root, $this->getVar('method'));
	 	$this->deleteDataStore($this->getVar('path'), $this->getVar('filename'));
	 	return $this->saveDataStore($this->_getData(), $this->getVar('path') . DIRECTORY_SEPARATOR . $this->getVar('filename') . '.' . $this->_extensions[$this->getVar('method')]);
	 }
	 
	 /**
	  *
	  * @param string $this->getVar('path')
	  * @param string $this->getVar('filename')
	  * @return multitype:
	  */
	 public function load()
	 {
	 	$this->__data = array();
 		if ($filename = $this->file_exists($this->getVar('path'), $this->getVar('filename'))) {
	 		return $this->_assignData($this->convert($this->readDataStore($filename, $this->getVar('md5_store')),$this->_root, $this->_getFunction($this->getVar('method'))), $this->getVar('md5_data'));
	 	}
	 	return false;
	 }
	 
	 /**
	  * 
	  * @param string $path
	  * @param string $filename
	  * @return string|boolean
	  */
	 public function file_exists($path = '', $filename = '')
	 {
	 	foreach(RadiooIOHandler::getMethods() as $extension => $function)
	 	{
	 		if (file_exists($file = $path . DIRECTORY_SEPARATOR . $filename . '.' . $extension))
	 			return $file;
	 
	 	}
	 	return false;
	 }
	 
	 /**
	  * 
	  * @param unknown $data
	  * @param string $md5
	  * @return boolean
	  */
	 public function _assignData($data = array(), $md5 = '')
	 {
	 	if ($md5 == $this->_calcMD5($data))
	 	{
	 		$this->setVar('md5_data', $md5);
	 		$this->setVar('bytes_data', $this->_calcBytes($data));
	 		if ($this->__data = $data)
	 			return true;
	 	}
	 	return false;
	 }
	 
	 /**
	  * 
	  * @return multitype:
	  */
	 public function _getData()
	 {
	 	return $this->__data;
	 }
	 
	 /**
	  * 
	  * @param unknown $data
	  * @return string
	  */
	 public function _calcMD5($data)
	 {
	 	$hash = md5(NULL);
	 	if (is_array($data))
		 	foreach($data as $key => $valuing)
		 	{
		 		if (is_array($valuing))
		 			$hash = md5($key . $this->_calcMD5($valuing) . $hash);
		 		else 
		 			$hash = md5($key . $valuing . $hash);
		 	}
		else 
			$hash = md5($data . $hash);
	 	return $hash;
	 }

	 /**
	  *
	  * @param unknown $data
	  * @return string
	  */
	 public function _calcBytes($data)
	 {
	 	$bytes = 0;
	 	if (is_array($data))
		 	foreach($data as $key => $valuing)
		 	{
		 		if (is_array($valuing))
		 			$bytes = $bytes + strlen($key) + $this->_calcBytes($valuing);
		 		else
		 			$bytes = $bytes + strlen($key) + strlen($valuing);
		 	}
	 	else
	 		$bytes = $bytes + strlen($data);
	 	return $bytes;
	 }	 
	 
	 /**
	  * 
	  * @param string $method
	  * @return Ambigous <>
	  */
	 public function _getFunction($method = 'json')
	 {
	 	$_methods = RadiooIOHandler::getMethods();
	 	if (!in_array($method, array_keys($_methods)))
	 		$method = 'json'; 
	 	if (isset($_methods[$method]))
	 		return $_methods[$method];
	 }
	 
	 /**
	  *
	  */
	 private function modifyNumericKeys($array = '', $convert = false, $spatial = '___')
	 {
	 	if (!$convert) {
	 		$changed = false;
	 		$values = array();
	 		foreach(array_reverse(array_keys($array)) as $key)
	 		{
	 			if (is_numeric($key))
	 			{
	 				$changed = true;
	 				$newkey = $spatial . $key . $spatial;
	 				if (is_array($values[$key]))
	 					$values[$newkey] = $this->modifyNumericKeys($array[$key], $convert);
	 				else
	 					$values[$newkey] = $array[$key];
	 				unset($array[$key]);
	 			}
	 		}
	 		if ($changed == true) {
	 			foreach(array_reverse(array_keys($values)) as $key)
	 			{
	 				$array[$key] = $values[$key];
	 			}
	 		}
	 	} else {
	 		$changed = false;
	 		$values = array();
	 		foreach(array_reverse(array_keys($array)) as $key)
	 		{
	 			if (substr($key, 0, strlen($spatial)) == $spatial && substr($key, strlen($key) - strlen($spatial), strlen($spatial)) == $spatial )
	 			{
	 				$changed = true;
	 				$newkey = substr($key, strlen($spatial), strlen($key) - strlen($spatial) - strlen($spatial));
	 				if (is_array($values[$key]))
	 					$values[$newkey] = $this->modifyNumericKeys($array[$key], $convert);
	 				else
	 					$values[$newkey] = $array[$key];
	 				unset($array[$key]);
	 			}
	 		}
	 		if ($changed == true) {
	 			foreach(array_reverse(array_keys($values)) as $key)
	 			{
	 				$array[$key] = $values[$key];
	 			}
	 		}
	 	}
	 	return $array;
	 }

	/**
	 * 
	 */
	 private function generateToken()
	 {
	 	return sha1($this->getVar('filename').$this->getVar('path').$this->getCryptingSalt().microtime(true));
	 }	 
	 
	 /**
	  *
	  * @param string $filename
	  * @return boolean|string
	  */
	 private function parse($array = array())
	 {
	 	if (!in_array($this->getVar('method'), array_keys(RadiooIOHandler::getMethods())))
	 		$this->setVar('method', $this->_method);
	 	$function = $this->_getFunction($this->getVar('method'));
	 	return $this->$function((!empty($this->_root)?array($this->_root => $array):$array));
	 }
	 
	 /**
	  *
	  * @param string $filename
	  * @return boolean|string
	  */
	 private function convert($data = '')
	 {
	 	if (!in_array($this->getVar('method'), array_keys(RadiooIOHandler::getMethods())))
	 		$this->setVar('method', $this->_method);
	 	$function = $this->_getFunction($this->getVar('method'));
	 	$ret = $this->$function($data);
	 	return (isset($ret[$this->_root])?$ret[$this->_root]:$ret);
	 }
	 
	 /**
	  *
	  * @param string $mixed
	  * @param string $directive
	  * @return string|mixed|boolean
	  */
	 private function parseXML($mixed = '', $directive = '')
	 {
	 	if (empty($directive))
	 	{
	 		if (is_array($mixed))
	 			$directive = 'pack';
	 		else
	 			$directive = 'unpack';
	 	}
	 	switch ($directive)
	 	{
	 		case "pack":
	 			$dom = new RadiooXMLObjectivity('1.0', 'utf-8');
	 			$dom->fromMixed($this->modifyNumericKeys($array, false));
	 			return $dom->saveXML();
	 			break;
	 		case "unpack":
	 			return $this->modifyNumericKeys(RadiooXMLtoArray::createArray($mixed), true);
	 			break;
	 	}
	 	return false;
	 }
	 
	 /**
	  *
	  * @param string $mixed
	  * @param string $directive
	  * @return string|mixed|boolean
	  */
	 private function parseJSON($mixed = '', $directive = '')
	 {
	 	if (empty($directive))
	 	{
	 		if (is_array($mixed))
	 			$directive = 'pack';
	 		else
	 			$directive = 'unpack';
	 	}
	 	switch ($directive)
	 	{
	 		case "pack":
	 			return json_encode($mixed);
	 			break;
	 		case "unpack":
	 			return json_decode($mixed, true);
	 			break;
	 	}
	 	return false;
	 }
	 
	 /**
	  *
	  * @param string $mixed
	  * @param string $directive
	  * @return string|mixed|boolean
	  */
	 private function parseSerialisation($mixed = '', $directive = '')
	 {
	 	if (empty($directive))
	 	{
	 		if (is_array($mixed))
	 			$directive = 'pack';
	 		else
	 			$directive = 'unpack';
	 	}
	 	switch ($directive)
	 	{
	 		case "pack":
	 			return serialize($mixed);
	 			break;
	 		case "unpack":
	 			return unserialize($mixed);
	 			break;
	 	}
	 	return false;
	 }
	 
	 /**
	  *
	  * @param string $filename
	  * @return boolean|string
	  */
	 private function deleteDataStore()
	 {
	 	foreach(RadiooIOHandler::getMethods() as $extension => $function)
	 	{
	 		if ($file = $this->file_exists($this->getVar('path'), $this->getVar('filename')))
	 			if (unlink($file))
	 				$this->setVar('deleted', time(true));
	 			
	 	}
	 	return true;
	 }
	 
	 
	 /**
	  *
	  * @param string $filename
	  * @return boolean|string
	  */
	 private function readDataStore($filename = '', $md5 = '')
	 {
	 	$store = array();
	 	if ($store = $this->decryptDataStore(RadiooFileSystem::getFileContents($filename)))
	 		$this->setVar('read', time(true));
	 	if ($md5 == $this->_calcMD5($store))
	 		return $store;
	 	return array();
	 }
	 
	 /**
	  *
	  * @param string $data
	  * @param string $filename
	  * @return boolean
	  */
	 private function saveDataStore($data = '', $filename = '')
	 {
	 	if (file_exists($filename))
	 		unlink($filename);
	 
	 	if (empty($data))
	 		return false;
	 
	 	if (RadiooFileSystem::saveFileContent($filename, $this->encryptDataStore($data)))
	 	{
	 		$this->setVar('saved', time(true));
	 		$this->setVar('md5_store', md5_file($filename));
	 		$this->setVar('bytes_store', filesize($filename));
	 		if (strlen($this->getVar('token')))
	 			$this->setVar('token', $this->generateToken());
	 	}

	 }
	 
	/**
	 * 
	 * @param string $data
	 * @return Ambigous <s, string>|string
	 */
	 private function encryptDataStore($data = '')
	 {
	 	if ($this->hasCryptingSalt() && class_exists('RadiooCrypt'))
	 	{
	 		$crypt = new RadiooCrypt($this->getCryptingSalt());
	 		return $crypt->encrypt($data);
	 	}
	 	return $data;
	 }
	 
	/**
	 * 
	 * @param string $data
	 * @return Ambigous <s, string>|string
	 */
	 private function decryptDataStore($data = '')
	 {
	 	if ($this->hasCryptingSalt() && class_exists('RadiooCrypt'))
	 	{
	 		$crypt = new RadiooCrypt($this->getCryptingSalt());
	 		return $crypt->decrypt($data);
	 	}
	 	return $data;
	 }
}

/**
 * 
 * @author Simon Roberts <simon@labs.coop>
 *
 */
class RadiooIOHandler extends XoopsPersistableObjectHandler
{
 
	/**
	 * 
	 * @var array()
	 */
	static protected $__methods = array('json' => 'parseJSON', 'xml' => 'parseXML', 'serial' => 'parseSerialisation');
	
	/**
	 *
	 * @var array()
	 */
	static protected $__suffix = array('json' => 'json', 'xml' => 'xml', 'serial' => 'serial');
	
	/**
	 * 
	 * @param string $method
	 */
	function __construct(&$db)
	{
		parent::__construct($db, "radioo_iostores", "RadiooStore", "id");
	}
	
	/**
	 * 
	 * @return multitype:string
	 */
	static function getMethods()
	{
		return self::$__methods;
	}

	/**
	 * 
	 * @return multitype:string
	 */
	static function getFileSuffix()
	{
		return self::$__suffix;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see XoopsPersistableObjectHandler::insert()
	 */
	public function insert($object, $force = true)
	{
		$object->save();
		return parent::insert($object, $force);
	}


	/**
	 * 
	 * @param string $filename
	 * @param string $path
	 * @param unknown $data
	 * @return mixed
	 */
	public function saveByFileSystem($filename = '', $path = '', $data = array())
	{
		$object = $this->getObjectByFileSystem($filename, $path);
		$object->_assignData($data, $object->_calcMD5($data));
		$object->setVar('filename', $filename);
		$object->setVar('path', $path);
		return $this->insert($object);
	}
	
	/**
	 * 
	 * @param string $token
	 * @param unknown $data
	 * @return mixed
	 */
	public function saveByToken($token = '', $data = array())
	{
		$object = $this->getObjectByToken($token);
		if (!$object->isNew())
		{
			$object->_assignData($data, $object->_calcMD5($data));
			$object->setVar('filename', $filename);
			$object->setVar('path', $path);
			return $this->insert($object);
		}
	}
	
	/**
	 * 
	 * @param string $filename
	 * @param string $path
	 * @return Ambigous <>
	 */
	public function getObjectByFileSystem($filename = '', $path = '')
	{
		$criteria = new CriteriaCompo(new Criteria('filename', $filename));
		$criteria->add(new Criteria('path', $path));
		if ($this->getCount($citeria)==1)
		{
			$objects = $this->getObjects($criteria, false);
			if (is_a($objects[0], "RadiooIO"))
				return $objects[0];
		}
		return $this->create();
	}
	
	/**
	 * 
	 * @param string $filename
	 * @param string $path
	 * @return multitype:
	 */
	public function getDataByFileSystem($filename = '', $path = '')
	{
		if (is_a($object = $this->getObjectByFileSystem($filename, $path), "RadiooIO"))
			return $object->_getData();
		return array();
	}
	
	/**
	 * 
	 * @param string $token
	 * @return unknown
	 */
	public function getObjectByToken($token = '')
	{
		$criteria = new CriteriaCompo(new Criteria('token', $token));
		if ($this->getCount($citeria)==1)
		{
			$objects = $this->getObjects($criteria, false);
			if (is_a($objects[0], "RadiooIO"))
				return $objects[0];
		}
		return $this->create();
	}

	/**
	 * 
	 * @param string $token
	 * @return multitype:
	 */
	public function getDataByToken($token = '')
	{
		if (is_a($object = $this->getObjectByToken($token), "RadiooIO"))
			return $object->_getData();
		return array();
	}
	
	/**
	 * 
	 * @param number $ioid
	 * @return multitype:
	 */
	public function getDataByID($ioid = 0)
	{
		if (is_a($object = $this->get($ioid), "RadiooIO"))
			return $object->_getData();
		return array();
	}
}