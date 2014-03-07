<?php

namespace ManiaLib\Manialink\Rendering;

use ManiaLib\Manialink\Node;
use SimpleXMLElement;

class SimpleXMLRenderer implements RendererInterface
{

	/**
	 * @var Node
	 */
	protected $root;

	protected function getElement(SimpleXMLElement $parent, Node $node)
	{
		$node->executeCallbacks('prefilter');
		
		$element = $parent->addChild($node::XML_TAG_NAME, $node->getNodeValue());
		foreach($node->getAttributes() as $name => $value)
		{
			$element->addAttribute($name, $value);
		}
		foreach($node->getChildren() as $child)
		{
			
			$this->getElement($element, $child);
			
		}
		
		$node->executeCallbacks('postfilter');
		
		return $element;
	}

	public function setRoot(Node $node)
	{
		$this->root = $node;
	}

	public function getXML()
	{
		return $this->getElement(new SimpleXMLElement('<dummy />'), $this->root)->asXML();
	}

}
