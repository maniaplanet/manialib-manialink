<?php

namespace ManiaLib\Manialink\Elements;

class Label extends Format
{

	const XML_TAG_NAME = 'label';

	/**
	 * @return \static
	 */
	function setText($text)
	{
		return $this->setAttribute("text", $text);
	}

	function getText()
	{
		return $this->getAttribute("text");
	}

	/**
	 * @return \static
	 */
	function setAutonewline($autonewline)
	{
		return $this->setAttribute("autonewline", $autonewline);
	}

	function getAutonewline()
	{
		return $this->getAttribute("autonewline");
	}

	/**
	 * @return \static
	 */
	function setMaxline($maxline)
	{
		return $this->setAttribute("maxline", $maxline);
	}

	function getMaxline()
	{
		return $this->getAttribute("maxline");
	}

}
