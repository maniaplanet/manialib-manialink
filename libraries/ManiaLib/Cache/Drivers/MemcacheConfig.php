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

namespace ManiaLib\Cache\Drivers;

class MemcacheConfig extends \ManiaLib\Utils\Singleton
{
	// TODO MANIALIB Memcahed config format should be improved
	public $hosts = array('127.0.0.1');
}
?>