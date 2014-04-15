<?php

namespace ManiaLib\Manialink\Layouts;

class LineRightToLeft extends AbstractLayout
{
	protected $init = false;
	
	function preFilter(\ManiaLib\Manialink\Elements\Base $node)
	{
		if (!$this->init && $this->getParent())
		{
			$this->xIndex = $this->getParent()->getSizenX();
			$this->init = true;
		}
		$this->xIndex -= $node->getRealSizenX() + $this->marginWidth;
	}

	function postFilter(\ManiaLib\Manialink\Elements\Base $node)
	{
	}

}
