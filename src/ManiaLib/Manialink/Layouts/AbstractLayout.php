<?php

namespace ManiaLib\Manialink\Layouts;

use ManiaLib\Manialink\Elements\Base;

abstract class AbstractLayout
{

	public $xIndex = 0;
	public $yIndex = 0;
	public $zIndex = 0;
	protected $marginWidth;
	protected $marginHeight;
	protected $borderWidth;
	protected $borderHeight;

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
	function setMarginWidth($marginWidth)
	{
		$this->marginWidth = $marginWidth;
		return $this;
	}

	/**
	 * @return \static
	 */
	function setMarginHeight($marginHeight)
	{
		$this->marginHeight = $marginHeight;
		return $this;
	}

	/**
	 * @return \static
	 */
	function setMargin($marginWidth, $marginHeight)
	{
		$this->setMarginWidth($marginWidth);
		$this->setMarginHeight($marginHeight);
		return $this;
	}

	/**
	 * @return \static
	 */
	function setBorderWidth($borderWidth)
	{
		$this->borderWidth = $borderWidth;
		$this->xIndex = $borderWidth;
		return $this;
	}

	/**
	 * @return \static
	 */
	function setBorderHeight($borderHeight)
	{
		$this->borderHeight = $borderHeight;
		$this->yIndex = - $borderHeight;
		return $this;
	}

	/**
	 * @return \static
	 */
	function setBorder($borderWidth, $borderHeight)
	{
		$this->setBorderWidth($borderWidth);
		$this->setBorderHeight($borderHeight);
		return $this;
	}

	function getMarginWidth()
	{
		return $this->marginWidth;
	}

	function getMarginHeight()
	{
		return $this->marginHeight;
	}

	function getBorderWidth()
	{
		return $this->borderWidth;
	}

	function getBorderHeight()
	{
		return $this->borderHeight;
	}

	function updateChild(Base $node)
	{
		$node->setPosnX($node->getPosnX() + $this->xIndex);
		$node->setPosnY($node->getPosnY() + $this->yIndex);
		$node->setPosnZ($node->getPosnZ() + $this->zIndex);
	}

	abstract function preFilter(Base $node);

	abstract function postFilter(Base $node);
}
