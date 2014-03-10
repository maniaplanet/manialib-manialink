<?php

namespace ManiaLib\Manialink\Rendering;

use ManiaLib\Manialink\Node;

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
		$this->driver = new Drivers\DOMDocumentDriver();
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
		return $this->driver->getXML($this->root);
	}

}
