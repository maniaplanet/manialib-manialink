<?php

namespace ManiaLib\Manialink\Layouts;

class ColumnUp extends AbstractLayout
{

	function preFilter(\ManiaLib\Manialink\Elements\Base $node)
	{
		$this->yIndex += $node->getRealSizenY() + $this->marginHeight;
	}

	function postFilter(\ManiaLib\Manialink\Elements\Base $node)
	{
	}

}
