<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\XML\Node;

class Timeout extends Node
{

	protected $nodeName = 'timeout';

	function __construct()
	{
		parent::__construct();
		$this->setNodeValue(0);
	}

}
