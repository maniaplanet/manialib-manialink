<?php

namespace ManiaLib\Manialink\Rendering\Drivers;

use DOMDocument;
use ManiaLib\Manialink\Node;

class DOMDocumentDriver implements \ManiaLib\Manialink\Rendering\DriverInterface
{

	/**
	 * @var DOMDocument
	 */
	protected $document;

	function __construct()
	{
		$this->document = new DOMDocument('1.0', 'UTF-8');
	}

	function getXML(Node $root)
	{
		$this->document->appendChild($this->getElement($root));
		return $this->document->saveXML();
	}

	function appendXML($xml)
	{
		$fragment = $this->document->createDocumentFragment();
		$fragment->appendXML($xml);
		return $fragment;
	}

	protected function getElement(Node $node)
	{
		// XML fragment?
		if($node instanceof \ManiaLib\Manialink\Elements\XMLFragment)
		{
			return $this->appendXML($node->getNodeValue());
		}

		// Filter
		$node->executeCallbacks('prefilter');

		// Create
		$element = $this->document->createElement($node::XML_TAG_NAME);

		// Value
		if($node->getNodeValue() !== null)
		{
			$element->appendChild($this->document->createTextNode($node->getNodeValue()));
		}

		// Attributes
		foreach($node->getAttributes() as $name => $value)
		{
			$element->setAttribute($name, $value);
		}

		// Children
		foreach($node->getChildren() as $child)
		{
			$subelement = $this->getElement($child);
			$element->appendChild($subelement);
		}

		// Filter
		$node->executeCallbacks('postfilter');

		return $element;
	}

}