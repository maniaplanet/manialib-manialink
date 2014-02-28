<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\Manialink\Node;

class Quad extends Node
{

	const XML_TAG_NAME = 'quad';

	function __construct()
	{
		$this->registerCallback('prefilter', array($this, 'filterPosition'), 'prefilter.position');
	}

	/**
	 * @return \static
	 */
	function setStyle($style)
	{
		$style = explode('::', $style);
		if(count($style) == 2)
		{
			list($_style, $_substyle) = $style;
			return $this->setAttribute('style', $_style)->setAttribute('substyle', $_substyle);
		}
		else
		{
			return $this->setAttribute('style', $_style);
		}
	}

	protected function filterPosition()
	{
		if(!$this->attributeExists('posn'))
		{
			$posnX = $this->getAttribute('posnX', 0);
			$posnY = $this->getAttribute('posnY', 0);
			$posnZ = $this->getAttribute('posnZ', 0);
			$this->deleteAttribute('posnX')->deleteAttribute('posnY')->deleteAttribute('posnZ');
			$this->setAttribute('posn', $posnX.' '.$posnY.' '.$posnZ);
		}
	}

}
