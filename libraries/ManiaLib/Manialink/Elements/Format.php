<?php

namespace ManiaLib\Manialink\Elements;

class Format extends Base
{

	const XML_TAG_NAME = 'format';

	/**
	 * @return \static
	 */
	function setTextprefix($textprefix)
	{
		return $this->setAttribute("textprefix", $textprefix);
	}

	function getTextprefix()
	{
		return $this->getAttribute("textprefix");
	}

	/**
	 * @return \static
	 */
	function setTextemboss($textemboss)
	{
		return $this->setAttribute("textemboss", $textemboss);
	}

	function getTextemboss()
	{
		return $this->getAttribute("textemboss");
	}

	/**
	 * @return \static
	 */
	function setTextcolor($textcolor)
	{
		return $this->setAttribute("textcolor", $textcolor);
	}

	function getTextcolor()
	{
		return $this->getAttribute("textcolor");
	}

	/**
	 * @return \static
	 */
	function setTextsize($textsize)
	{
		return $this->setAttribute("textsize", $textsize);
	}

	function getTextsize()
	{
		return $this->getAttribute("textsize");
	}

	/**
	 * @return \static
	 */
	function setFocusareacolor1($focusareacolor1)
	{
		return $this->setAttribute("focusareacolor1", $focusareacolor1);
	}

	function getFocusareacolor1()
	{
		return $this->getAttribute("focusareacolor1");
	}

	/**
	 * @return \static
	 */
	function setFocusareacolor2($focusareacolor2)
	{
		return $this->setAttribute("focusareacolor2", $focusareacolor2);
	}

	function getFocusareacolor2()
	{
		return $this->getAttribute("focusareacolor2");
	}

}
