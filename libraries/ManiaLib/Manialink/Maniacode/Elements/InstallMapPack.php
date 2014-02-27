<?php
/**
 * ManiaLib - Lightweight PHP framework for Manialinks
 *
 * @see         http://code.google.com/p/manialib/
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision$:
 * @author      $Author$:
 * @date        $Date$:
 */

namespace ManiaLib\Manialink\Maniacode\Elements;

class InstallMapPack extends \ManiaLib\Manialink\Maniacode\Component
{

	protected $xmlTagName = 'install_map_pack';
	protected $maps = array();

	function __construct($name='')
	{
		$this->name = $name;
	}

	function addMap($name = '', $url = '')
	{
		$this->maps[] = new \ManiaLib\Manialink\Maniacode\Elements\PackageMap($name, $url);
	}

	function getLastInsert()
	{
		return end($this->maps);
	}

	protected function postFilter()
	{
		if(isset($this->maps) && is_array($this->maps) && count($this->maps))
		{
			foreach($this->maps as $map)
			{
				$map->save();
			}
		}
	}

}

?>