<?php

namespace ManiaLib\Manialink\Layouts;

class Column extends AbstractLayout
{

	function preFilter(\ManiaLib\Manialink\Elements\Base $node)
	{
		
	}

	function postFilter(\ManiaLib\Manialink\Elements\Base $node)
	{
		$this->yIndex -= $node->getRealSizenY() + $this->marginHeight;
	}

}
