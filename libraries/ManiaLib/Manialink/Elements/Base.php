<?php

namespace ManiaLib\Manialink\Elements;

abstract class Base extends \ManiaLib\Manialink\Node
{

	function setId($id)
	{
		return $this->setAttribute("id", $id);
	}

	function getId()
	{
		return $this->getAttribute("id");
	}

	function setClass($class)
	{
		return $this->setAttribute("class", $class);
	}

	function getClass()
	{
		return $this->getAttribute("class");
	}

	function setHidden($hidden)
	{
		return $this->setAttribute("hidden", $hidden);
	}

	function getHidden()
	{
		return $this->getAttribute("hidden");
	}

}
