<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\Manialink\Node;

class Timeout extends Node
{

	protected $tagName = 'timeout';

	function __construct()
	{
		parent::__construct();
		$this->setNodeValue(0);
	}

}
