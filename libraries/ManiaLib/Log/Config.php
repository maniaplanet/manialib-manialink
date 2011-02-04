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
class Config extends \ManiaLib\Config\Configurable
{
	public $path;
	public $prefix;
	public $error = 'error.log';
	public $user = 'user-error.log';
	public $debug = 'debug.log';
	public $loader = 'loader.log';
	public $verbose = false;
	
	protected function validate()
	{
		$this->setDefault('path', defined('APP_PATH') ? APP_PATH.'logs/' : null);
	} 
}


?>