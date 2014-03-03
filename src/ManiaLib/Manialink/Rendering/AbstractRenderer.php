<?php

namespace ManiaLib\Manialink\Rendering;

use ManiaLib\Manialink\Node;

abstract class AbstractRenderer implements RendererInterface
{

	/**
	 * @var Node
	 */
	protected $root;

	public function setRoot(Node $node)
	{
		$this->root = $node;
	}

}
