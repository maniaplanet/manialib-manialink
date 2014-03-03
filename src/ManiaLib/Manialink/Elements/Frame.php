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

	function __construct()
	{
		parent::__construct();
		$this->registerCallback('prefilter', array($this, 'preFilterAlign'));
	}

	protected function preFilterSize()
	{
		// Override parent. Do nothing.
	}

	protected function preFilterAlign()
	{
		$this->deleteAttribute('halign')->deleteAttribute('valign');
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
