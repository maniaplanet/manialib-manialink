<?php

namespace ManiaLib\Manialink\Elements;

class Quad extends \ManiaLib\Manialink\Leaf
{

	const XML_TAG_NAME = 'quad';

	function __construct()
	{
		$this->appendPreFilter(array($this, 'filterPosition'));
	}

	protected function filterPosition()
	{
		if(!$this->attributeExists('posn'))
		{
			$posnX = $this->getAttribute('posnX', 0);
			$posnY = $this->getAttribute('posnY', 0);
			$posnZ = $this->getAttribute('posnZ', 0);
			$this->deleteAttribute('posnX')->deleteAttribute('posnY')->deleteAttribute('posnZ');
			$this->setAttribute('posn', sprintf("%d %d %d", $posnX, $posnY, $posnZ));
		}
	}

}
