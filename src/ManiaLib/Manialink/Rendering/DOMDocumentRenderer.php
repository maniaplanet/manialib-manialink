<?php

namespace ManiaLib\Manialink\Rendering;

use DOMDocument;
use ManiaLib\Manialink\Node;

class DOMDocumentRenderer implements RendererInterface
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
		$element = $this->getDOMDocument()->createElement($node::XML_TAG_NAME);
		if($node->getNodeValue() !== null)
		{
			$element->nodeValue = $node->getNodeValue();
			// TODO Should it create a text node instead of setting node value?
			//$element->appendChild($this->getDOMDocument()->createTextNode($node->getNodeValue()));
		}
		foreach($node->getAttributes() as $name => $value)
		{
			$element->setAttribute($name, $value);
		}
		foreach($node->getChildren() as $child)
		{
			// TODO Should filtering be done in the tree rather than in the renderer?
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
