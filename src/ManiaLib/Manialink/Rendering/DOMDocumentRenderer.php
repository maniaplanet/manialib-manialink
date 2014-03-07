<?php

namespace ManiaLib\Manialink\Rendering;

use DOMDocument;
use ManiaLib\Manialink\Node;

class DOMDocumentRenderer extends AbstractRenderer
{

	/**
	 * @var DOMDocument
	 */
	protected $document;

	function __construct()
	{
		$this->document = new DOMDocument('1.0', 'utf-8');
	}

	function setDOMDocument(DOMDocument $document)
	{
		$this->document = $document;
	}

	/**
	 * @return DOMDocument
	 */
	protected function getDOMDocument()
	{
		return $this->document;
	}

	protected function getDOMElement(Node $node)
	{
		$node->executeCallbacks('prefilter');
		
		$element = $this->getDOMDocument()->createElement($node::XML_TAG_NAME);
		if($node->getNodeValue() !== null)
		{
			$element->nodeValue = $node->getNodeValue();
		}
		foreach($node->getAttributes() as $name => $value)
		{
			$element->setAttribute($name, $value);
		}
		foreach($node->getChildren() as $child)
		{
			$subelement = $this->getDOMElement($child);
			$element->appendChild($subelement);
		}
		
		$node->executeCallbacks('postfilter');
		
		return $element;
	}

	function getXML()
	{
		$this->document->appendChild($this->getDOMElement($this->root));
		return $this->document->saveXML();
	}

}
