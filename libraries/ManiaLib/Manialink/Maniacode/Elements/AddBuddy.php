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

class AddBuddy extends \ManiaLib\Manialink\Maniacode\Component
{

	protected $xmlTagName = 'add_buddy';
	protected $login;

	function __construct($login)
	{
		$this->login = $login;
	}

	function setLogin($login)
	{
		$this->login = $login;
	}

	function getLogin()
	{
		return $this->login;
	}

	protected function postFilter()
	{
		if(isset($this->login))
		{
			$elem = \ManiaLib\Manialink\Maniacode\Maniacode::$domDocument->createElement('login');
			$value = \ManiaLib\Manialink\Maniacode\Maniacode::$domDocument->createTextNode($this->login);
			$elem->appendChild($value);
			$this->xml->appendChild($elem);
		}
	}

}

?>