<?php

namespace ManiaLib\Manialink\Cards;

use ManiaLib\Manialink\Elements\Label;

class LabelBox extends Box
{

	/**
	 * @var Label
	 */
	public $label;

	function __construct()
	{
		parent::__construct();
		$this->label = Label::create()->setBothAlign('center', 'center')->setPosn(0, 0, 0.1);
		$this->appendChild($this->label);
	}

	function preFilterSize()
	{
		parent::preFilterSize();

		if(!$this->label->getSizenX() && $this->label->getSizenY())
		{
			$this->label->setSizen($this->getSizenX(), $this->getSizenY());
		}
	}

}
