<?php

namespace ManiaLib\Manialink\Rendering;

use ManiaLib\Manialink\Exception;
use ManiaLib\Manialink\Node;
use ManiaLib\Manialink\Rendering\Drivers\DOMDocumentDriver;

class Renderer
{

	/**
	 * @var Node
	 */
	protected $root;

	/**
	 * @var DriverInterface
	 */
	protected $driver;

	function __construct()
	{
		$this->driver = new DOMDocumentDriver();
	}

	function setRoot(Node $node)
	{
		$this->root = $node;
	}

	function setDriver(DriverInterface $driver)
	{
		$this->driver = $driver;
	}

	function getXML()
	{
		if(!($this->root instanceof Node))
		{
			throw new Exception('No ManiaLib\Manialink\Node root found.');
		}
		if(!($this->driver instanceof DriverInterface))
		{
			throw new Exception('No ManiaLib\Manialink\DriverInterface driver found.');
		}
		return $this->driver->getXML($this->root);
	}

}
