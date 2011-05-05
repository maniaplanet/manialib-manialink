<?php
/**
 * ManiaLib - Lightweight PHP framework for Manialinks
 * 
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision$:
 * @author      $Author$:
 * @date        $Date$:
 */
namespace ManiaLib\Log;

/**
 * Log config
 */
class Config extends \ManiaLib\Utils\Singleton
{
	public $path;
	public $prefix;
	public $error = 'error.log';
	public $user = 'user.log';
	public $debug = 'info.log';
	public $loader = 'loader.log';
	public $verbose = false;
	
	function __construct()
	{
		$this->path = APP_PATH.'logs/';
	}
}


?>