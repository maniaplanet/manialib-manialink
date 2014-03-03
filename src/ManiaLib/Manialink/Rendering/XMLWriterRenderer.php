<?php

namespace ManiaLib\Manialink\Rendering;

use ManiaLib\Manialink\Node;
use SimpleXMLElement;

class XMLWriterRenderer extends AbstractRenderer
{

	/**
	 * @var \XMLWriter
	 */
	protected $writer;

	function __construct()
	{
		$this->writer = new \XMLWriter();
		$this->writer->openMemory();
		$this->writer->startDocument('1.0');
	}

	protected function writeElement(Node $node)
	{
		$this->writer->startElement($node::XML_TAG_NAME);
		if($node->getNodeValue())
		{
			$this->writer->text($node->getNodeValue());
		}
		foreach($node->getAttributes() as $name => $value)
		{
			$this->writer->writeAttribute($name, $value);
		}
		foreach($node->getChildren() as $child)
		{
			$child->executeCallbacks('prefilter');
			$this->writeElement($child);
			$child->executeCallbacks('postfilter');
		}
		$this->writer->endElement();
	}

	public function getXML()
	{
		$this->writeElement($this->root);
		$this->writer->endDocument();
		return $this->writer->outputMemory(true);
	}

}
