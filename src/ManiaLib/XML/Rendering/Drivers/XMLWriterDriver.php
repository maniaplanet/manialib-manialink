<?php

namespace ManiaLib\XML\Rendering\Drivers;

use ManiaLib\XML\Node;
use ManiaLib\XML\Rendering\DriverInterface;

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

	function getXML(Node $root)
	{
		$this->getElement($root);
		$this->writer->endDocument();
		return $this->writer->outputMemory(true);
	}

	function appendXML($xml)
	{
		$this->writer->writeRaw($xml);
	}

	protected function getElement(Node $node)
	{
		// XML fragment?
		if($node instanceof \ManiaLib\XML\Fragment)
		{
			return $this->appendXML($node->getNodeValue());
		}

		// Filter
		$node->executeCallbacks('prefilter');

		// Create
		$this->writer->startElement($node->getNodeName());

		// Value
		if($node->getNodeValue() !== null)
		{
			$this->writer->writeRaw(htmlspecialchars($node->getNodeValue(), ENT_NOQUOTES, 'UTF-8'));
		}

		// Attributes
		foreach($node->getAttributes() as $name => $value)
		{
			$this->writer->writeAttribute($name, $value);
		}

		// Children
		foreach($node->getChildren() as $child)
		{
			$this->getElement($child);
		}

		// End create
		$this->writer->endElement();

		// Filter
		$node->executeCallbacks('postfilter');
	}

}
