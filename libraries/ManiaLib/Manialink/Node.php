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
	 * @var callable[]
	 */
	protected $preFilters = array();

	/**
	 * @var callable[]
	 */
	protected $postFilters = array();

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

	function appendPreFilter($callback)
	{
		array_push($this->preFilters, $callback);
	}

	function prependPreFilter($callback)
	{
		array_unshift($this->preFilters, $callback);
	}

	function getPreFilters()
	{
		return $this->preFilters;
	}

	function appendPostFilter(callable $callback)
	{
		array_push($this->postFilters, $callback);
	}

	function prependPostFilter(callable $callback)
	{
		array_unshift($this->postFilters, $callback);
	}

	function getPostFilters()
	{
		return $this->postFilters;
	}

	function preFilter()
	{
		foreach($this->getPreFilters() as $callback)
		{
			call_user_func($callback);
		}
	}

	function postFilter()
	{
		foreach($this->getPostFilters() as $callback)
		{
			call_user_func($callback);
		}
	}

}
