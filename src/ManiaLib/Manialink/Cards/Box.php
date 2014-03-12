<?php

namespace ManiaLib\Manialink\Cards;

use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Quad;

class Box extends Frame
{

	/**
	 * @var Quad
	 */
	protected $bg;

	function __construct()
	{
		parent::__construct();
		$this->bg = Quad::create()->appendTo($this);
	}

	protected function preFilterSize()
	{
		parent::__construct();
		$this->bg->setSizen($this->getSizenX(), $this->getSizenY());
	}

	/**
	 * @return Quad
	 */
	function getBg()
	{
		return $this->bg;
	}

}
