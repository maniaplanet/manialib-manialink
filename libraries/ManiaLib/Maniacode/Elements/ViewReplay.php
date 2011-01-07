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

namespace ManiaLib\Maniacode\Elements;

/**
 * View replay
 */
class ViewReplay extends \ManiaLib\Maniacode\Elements\FileDownload
{
	/**
	 * @ignore
	 */
	protected $xmlTagName = 'view_replay';
	
	function __construct($name='', $url='')
	{
		parent::__construct($name, $url);
	}
}


?>