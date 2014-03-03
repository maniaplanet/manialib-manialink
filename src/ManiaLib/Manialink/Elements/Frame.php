<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\Manialink\Layouts\AbstractLayout;

class Frame extends Base
{

	const XML_TAG_NAME = 'frame';
	
	/**
	 * @var AbstractLayout
	 */
	protected $layout;

	protected function preFilterSize()
	{
		// Override parent. Do nothing.
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
