<?php

namespace ManiaLib\Manialink\Cards;

class Box extends \ManiaLib\Manialink\Elements\Frame
{

	/**
	 * @var \ManiaLib\Manialink\Elements\Quad
	 */
	public $bg;

	function __construct()
	{
		parent::__construct();
		$this->bg = new \ManiaLib\Manialink\Elements\Quad();
		$this->appendChild($this->bg);
	}

	function preFilterSize()
	{
		parent::__construct();
		$this->bg->setSizen($this->getSizenX(), $this->getSizenY());
	}

}
