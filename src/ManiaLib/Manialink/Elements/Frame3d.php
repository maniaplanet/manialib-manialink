<?php

namespace ManiaLib\Manialink\Elements;

class Frame3d extends Base
{

	const XML_TAG_NAME = 'frame3d';

	/**
	 * @return \static
	 */
	function setStyle3D($style3D)
	{
		return $this->setAttribute("style3d", $style3D);
	}

	function getStyle3D()
	{
		return $this->getAttribute("style3d");
	}
	
	/**
	 * @return AbstractLayout
	 */
	function getLayout()
	{
		return $this->layout;
	}

	/**
	 * @return \static
	 */
	function setLayout(AbstractLayout $layout)
	{
		$this->layout = $layout;
		return $this;
	}

}
