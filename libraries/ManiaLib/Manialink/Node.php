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
			throw new Exception('Cannot remove a child: it does not exist.');
		}
		$this->children->deleteParent();
		unset($this->children[$key]);
	}

	function registerCallback($event, $callback, $id = null)
	{
		if(!is_callable($callback))
		{
			throw new Exception('Provided $callback is not callable in '.get_called_class());
		}
		if($id === null)
		{
			$this->callbacks[$event][] = $callback;
		}
		else
		{
			$this->callbacks[$event][$id] = $callback;
		}
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
