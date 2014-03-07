<?php

namespace ManiaLib\Manialink\Elements;

class Quad extends Base
{

	const XML_TAG_NAME = 'quad';

	/**
	 * @return \static
	 */
	function setImage($image)
	{
		return $this->setAttribute("image", $image);
	}

	function getImage()
	{
		return $this->getAttribute("image");
	}

	/**
	 * @return \static
	 */
	function setImagefocus($imagefocus)
	{
		return $this->setAttribute("imagefocus", $imagefocus);
	}

	function getImagefocus()
	{
		return $this->getAttribute("imagefocus");
	}

	/**
	 * @return \static
	 */
	function setBgcolor($bgcolor)
	{
		return $this->setAttribute("bgcolor", $bgcolor);
	}

	function getBgcolor()
	{
		return $this->getAttribute("bgcolor");
	}
	
	/**
	 * @return \static
	 */
	function setBgcolorFocus($bgcolor)
	{
		return $this->setAttribute("bgcolorfocus", $bgcolor);
	}

	function getBgcolorfocus()
	{
		return $this->getAttribute("bgcolorfocus");
	}
	

}
