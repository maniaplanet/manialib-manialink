<?php

namespace ManiaLib\XML\Rendering;

use ManiaLib\XML\Exception;
use ManiaLib\XML\Node;
use ManiaLib\XML\Rendering\Drivers\DOMDocumentDriver;

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
			throw new Exception('No ManiaLib\XML\Node root found.');
		}
		if(!($this->driver instanceof DriverInterface))
		{
			throw new Exception('No ManiaLib\XML\Rendering\DriverInterface driver found.');
		}
		return $this->driver->getXML($this->root);
	}

}
