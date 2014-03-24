<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\Manialink\Node;

class Manialink extends Node
{

	const XML_TAG_NAME = 'manialink';

	function __construct()
	{
		parent::__construct();
		$this->setVersion(1);
	}

	/**
	 * @return \static
	 */
	function setVersion($value)
	{
		return $this->setAttribute('version', $value);
	}

	/**
	 * @return \static
	 */
	function setBackground($value)
	{
		return $this->setAttribute('background', $value);
	}

	/**
	 * @return \static
	 */
	function setNavigable3d($value)
	{
		return $this->setAttribute('navigable3d', $value);
	}

}
