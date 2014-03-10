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

	public function getXML(Node $root)
	{
		$this->document->appendChild($this->getElement($root));
		return $this->document->saveXML();
	}

	protected function getElement(Node $node)
	{
		$node->executeCallbacks('prefilter');

		$element = $this->document->createElement($node::XML_TAG_NAME);
		if($node->getNodeValue() !== null)
		{
			$element->appendChild($this->document->createTextNode($node->getNodeValue()));
		}
		foreach($node->getAttributes() as $name => $value)
		{
			$element->setAttribute($name, $value);
		}
		foreach($node->getChildren() as $child)
		{
			$subelement = $this->getElement($child);
			$element->appendChild($subelement);
		}

		$node->executeCallbacks('postfilter');

		return $element;
	}

}
