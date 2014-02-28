<?php

namespace ManiaLib\Manialink;

abstract class Node
{

	const XML_TAG_NAME = null;

	protected $attributes = array();
	protected $nodeValue;

	/**
	 * @var Node[]
	 */
	protected $children = array();

	/**
	 * @var Node
	 */
	protected $parent;

	/**
	 * @var callable[][]
	 */
	protected $callbacks = array();

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

	/**
	 * @return \static
	 */
	function setNodeValue($value)
	{
		$this->nodeValue = $value;
		return $this;
	}

	function getNodeValue()
	{
		return $this->nodeValue;
	}

//	function setParent(Node $node)
//	{
//		$this->parent = $node;
//	}
//
//	function deleteParent()
//	{
//		$this->parent = null;
//	}
//
//	/**
//	 * @return Node
//	 */
//	function getParent()
//	{
//		return $this->parent;
//	}

	function getChildren()
	{
		return $this->children;
	}

	/**
	 * @return \static
	 */
	function appendChild(Node $child)
	{
		$this->children[] = $child;
		//$child->setParent($this);
		return $this;
	}

	function removeChild(Node $child)
	{
		$key = array_search($child, $this->children);
		if($key === false)
		{
			throw new Exception('Cannot remove a child: it does not exist.');
		}
		$this->children->deleteParent();
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
