<?php

namespace ManiaLib\Manialink\Rendering\Drivers;

use ManiaLib\Manialink\Node;
use ManiaLib\Manialink\Rendering\DriverInterface;
use SimpleXMLElement;

class SimpleXMLDriver implements DriverInterface
{

	/**
	 * @var SimpleXMLElement
	 */
	protected $parent;

	function __construct()
	{
		$this->parent = new SimpleXMLElement('<dummy />');
	}

	public function getXML(Node $root)
	{
		return '<?xml version="1.0" encoding="UTF-8"?>'."\n".$this->getElement($root)->asXML()."\n";
	}

	protected function getElement(Node $node)
	{
		// Filter
		$node->executeCallbacks('prefilter');

		// Create
		// Value
		$value = $node->getNodeValue() !== null ? htmlspecialchars($node->getNodeValue(), ENT_COMPAT,
				'UTF-8') : null;
		$element = $this->parent->addChild($node::XML_TAG_NAME, $value);

		// Attributes
		foreach($node->getAttributes() as $name => $value)
		{
			$element->addAttribute($name, $value);
		}
		
		// Children
		$parent = $this->parent;
		$this->parent = $element;
		foreach($node->getChildren() as $child)
		{
			$this->getElement($child);
		}
		$this->parent = $parent;
		
		// Filter
		$node->executeCallbacks('postfilter');

		return $element;
	}

}
