<?php

namespace ManiaLib\XML;

class Node
{

	/**
	 * @var string
	 */
	protected $nodeName;

	/**
	 * @var string
	 */
	protected $nodeValue;

	/**
	 * @var mixed[]
	 */
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
	 * @var Node
	 */
	protected $current;

	/**
	 * @var callable[][]
	 */
	protected $callbacks = array();

	/**
	 * @return \static
	 */
	final static function create()
	{
		return new static;
	}

	function __construct()
	{
		$this->current = $this;
	}

	function __clone()
	{
		$this->deleteParent();

		foreach($this->children as $key => $child)
		{
			$cloned = clone $child;
			foreach($this as $propertyName => $propertyValue)
			{
				if($child === $propertyValue)
				{
					$this->$propertyName = $cloned;
				}
			}
			$this->removeChild($child);
			$this->appendChild($cloned);
		}

		foreach($this->callbacks as $id => $callbacks)
		{
			foreach($callbacks as $key => $callback)
			{
				if(is_array($callback) && count($callback) == 2)
				{
					list($object, $method) = $callback;
					if($object == $this->current)
					{
						// There may be some weird edge cases, but this should cover most of the cloning issues.
						$this->callbacks[$id][$key] = array($this, $method);
					}
				}
			}
		}

		$this->current = $this;
	}

	/**
	 * @return \static
	 */
	final function getClone()
	{
		return clone $this;
	}

	/**
	 * USE AT YOUR OWN RISK!
	 * Change the XML tag name
	 * 
	 * @return \static
	 */
	function setNodeName($nodeName)
	{
		$this->nodeName = $nodeName;
		return $this;
	}

	/**
	 * @return string
	 */
	function getNodeName()
	{
		return $this->nodeName;
	}

	/**
	 * @return \static
	 */
	function setNodeValue($value)
	{
		$this->nodeValue = $value;
		return $this;
	}

	/**
	 * @return \static
	 */
	function appendNodeValue($value)
	{
		$this->nodeValue .= $value;
		return $this;
	}

	function getNodeValue()
	{
		return $this->nodeValue;
	}

	/**
	 * @return \static
	 */
	function setAttribute($name, $value)
	{
		$this->attributes[$name] = $value;
		return $this;
	}

	/**
	 * @return \static
	 */
	function appendAttribute($name, $value)
	{
		$this->attributes[$name] .= $value;
		return $this;
	}

	function attributeExists($name)
	{
		return array_key_exists($name, $this->attributes);
	}

	function getAttribute($name, $default = null)
	{
		return $this->attributeExists($name) ? $this->attributes[$name] : $default;
	}

	function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * @return \static
	 */
	function deleteAttribute($name)
	{
		unset($this->attributes[$name]);
		return $this;
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

	function getChildren()
	{
		return $this->children;
	}

	/**
	 * @return \static
	 */
	function appendChild(Node $child)
	{
		if($child->getParent() instanceof Node)
		{
			throw new Exception('Cannot append a child: it already has a parent Node.');
		}
		$this->children[] = $child;
		$child->setParent($this);
		return $this;
	}

	/**
	 * @return \static
	 */
	function appendTo(Node $parent)
	{
		$parent->appendChild($this);
		return $this;
	}

	function removeChild(Node $child)
	{
		$key = array_search($child, $this->children);
		if($key === false)
		{
			throw new Exception('Cannot remove a child: it does not exist.');
		}
		$this->children[$key]->deleteParent();
		unset($this->children[$key]);
	}

	function registerCallback($event, $callback)
	{
		if(!is_callable($callback))
		{
			throw new Exception('Provided $callback is not callable in '.get_called_class());
		}
		$this->callbacks[$event][] = $callback;
	}

	function prependCallback($event, $callback)
	{
		if(!is_callable($callback))
		{
			throw new Exception('Provided $callback is not callable in '.get_called_class());
		}
		array_unshift($this->callbacks[$event], $callback);
		return $this;
	}

	function executeCallbacks($event, $parameters = array())
	{
		if(array_key_exists($event, $this->callbacks))
		{
			foreach($this->callbacks[$event] as $callback)
			{
				call_user_func_array($callback, $parameters);
			}
		}
	}

}
