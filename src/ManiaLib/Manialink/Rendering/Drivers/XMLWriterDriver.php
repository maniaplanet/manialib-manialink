<?php

namespace ManiaLib\Manialink\Rendering\Drivers;

use ManiaLib\Manialink\Node;
use ManiaLib\Manialink\Rendering\DriverInterface;

class XMLWriterDriver implements DriverInterface
{

	/**
	 * @var \XMLWriter
	 */
	protected $writer;

	function __construct()
	{
		$this->writer = new \XMLWriter();
		$this->writer->openMemory();
		$this->writer->startDocument('1.0', 'UTF-8');
	}

	public function getXML(Node $root)
	{
		$this->getElement($root);
		$this->writer->endDocument();
		return $this->writer->outputMemory(true);
	}

	protected function getElement(Node $node)
	{
		$node->executeCallbacks('prefilter');

		$this->writer->startElement($node::XML_TAG_NAME);
		if($node->getNodeValue() !== null)
		{
			$this->writer->writeRaw(htmlspecialchars($node->getNodeValue(), ENT_NOQUOTES, 'UTF-8'));
		}
		foreach($node->getAttributes() as $name => $value)
		{
			$this->writer->writeAttribute($name, $value);
		}
		foreach($node->getChildren() as $child)
		{
			$this->getElement($child);
		}
		$this->writer->endElement();

		$node->executeCallbacks('postfilter');
	}

}
