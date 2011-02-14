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

// FIXME Useless with the new config system

namespace ManiaLib\Utils;

/**
 * Debug stuff
 */
abstract class Debug
{
	static function isDebug()
	{
		return \ManiaLib\Config\Config::getInstance()->debug;
	}
}

?>