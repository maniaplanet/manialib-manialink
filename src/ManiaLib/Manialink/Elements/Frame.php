<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\Manialink\Utils;
use ManiaLib\Manialink\Layouts\AbstractLayout;

class Frame extends Base
{

	protected $nodeName = 'frame';

	/**
	 * @var AbstractLayout
	 */
	protected $layout;

	function __construct()
	{
		parent::__construct();
		$this->prependCallback(self::EVENT_PREFILTER, array($this, 'preFilterAlign'));
	}
	
	function __clone()
	{
		parent::__clone();
		if($this->layout instanceof AbstractLayout)
		{
			$this->layout = clone $this->layout;
		}
	}

	protected function preFilterSize()
	{
		// Override parent. Do nothing.
	}

	protected function preFilterAlign()
	{
		$halign = $this->getHalign();
		$valign = $this->getValign();
		if ($halign)
		{
			$this->setPosnX(Utils::getAlignedPosX($this->getPosnX(), $this->getRealSizenX(), $halign, "left"));
			$this->deleteAttribute('halign');
		}
		if ($valign)
		{
			$this->setPosnY(Utils::getAlignedPosY($this->getPosnY(), $this->getRealSizenY(), $valign, "top"));
			$this->deleteAttribute('valign');
		}
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
		$this->layout = $layout->setParent($this);
		return $this;
	}

}
