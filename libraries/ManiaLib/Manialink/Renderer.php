<?php

namespace ManiaLib\Manialink;

class Renderer
{

	/**
	 * @var \DOMDocument
	 */
	protected $document;

	/**
	 * @var Node
	 */
	protected $root;

	function __construct()
	{
		$this->document = new \DOMDocument('1.0', 'utf-8');
	}

	function setDOMDocument(\DOMDocument $document)
	{
		$this->document = $document;
	}

	/**
	 * @return \DOMDocument
	 */
	function getDOMDocument()
	{
		return $this->document;
	}

	function setRoot(Node $root)
	{
		$this->root = $root;
	}

	function getDOMElement(Node $node)
	{
		$element = $this->getDOMDocument()->createElement($node::XML_TAG_NAME);
		foreach($node->getAttributes() as $name => $value)
		{
			$element->setAttribute($name, $value);
		}
		foreach($node->getChildren() as $child)
		{
			// Should filtering be done in the tree rather than in the renderer?
			$child->executeCallbacks('prefilter');
			$subelement = $this->getDOMElement($child);
			$child->executeCallbacks('postfilter');
			
			$element->appendChild($subelement);
		}
		return $element;
	}

	function getXML()
	{
		$this->document->appendChild($this->getDOMElement($this->root));
		return $this->document->saveXML();
	}

}
