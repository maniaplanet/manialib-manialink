<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\Manialink\Node;

class Timeout extends Node
{

	const XML_TAG_NAME = 'timeout';

	function __construct()
	{
		parent::__construct();
		$this->setNodeValue(0);
	}

}
