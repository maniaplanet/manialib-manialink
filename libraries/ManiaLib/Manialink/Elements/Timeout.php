<?php

namespace ManiaLib\Manialink\Elements;

class Timeout extends \ManiaLib\Manialink\Leaf
{

	const XML_TAG_NAME = 'timeout';

	function __construct()
	{
		$this->setNodeValue(0);
	}

}
