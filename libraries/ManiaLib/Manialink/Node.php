<?php

namespace ManiaLib\Manialink;

abstract class Node
{

	const XML_TAG_NAME = null;

	protected $attributes = array();

	/**
	 * @var Node[]
	 */
	protected $children = array();

	/**
	 * @var Node
	 */
	protected $parent;

	/**
	 * @param \DOMDocument
	 */
	protected $document;

	/**
	 * @return \static
	 */
	static function create()
	{
		return new static;
	}

	/**
	 * @return \static
	 */
	function setAttribute($name, $value)
	{
		$this->attributes[$name] = $value;
		return $this;
	}

	function attributeExists($name)
	{
		return array_key_exists($name, $this->attributes);
	}

	function getAttribute($name)
	{
		if(!$this->attributeExists($name))
		{
			throw new \UnexpectedValueException(sprintf('Unknown attribute %s', $name));
		}
		return $this->attributes[$name];
	}

	function deleteAttribute($name)
	{
		unset($this->attributes[$name]);
	}

	function setParent(Node $node)
	{
		$this->parent = $node;
	}

	function deleteParent()
	{
		$this->parent = null;
	}

	/**
	 * @return Node
	 */
	function getParent()
	{
		return $this->parent;
	}

	function addChild(Node $child)
	{
		$this->children[] = $child;
		$child->setParent($this);
	}

	function removeChild(Node $child)
	{
		$key = array_search($child, $this->children);
		if($key === false)
		{
			throw new \UnexpectedValueException('Cannot remove a child: it does not exist.');
		}
		$this->children->deleteParent();
		unset($this->children[$key]);
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
		if(!$this->document)
		{
			$this->document = new \DOMDocument('1.0', 'utf-8');
		}
		return $this->document;
	}

	function getDOMElement()
	{
		$element = $this->getDOMDocument()->createElement(static::XML_TAG_NAME);
		foreach($this->attributes as $name => $value)
		{
			$element->setAttribute($name, $value);
		}
		foreach($this->children as $child)
		{
			$child->setDOMDocument($this->getDOMDocument());
			$element->appendChild($child->getDOMElement());
		}
		return $element;
	}

	function getXML()
	{
		
	}

}
