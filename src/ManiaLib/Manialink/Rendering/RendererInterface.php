<?php

namespace ManiaLib\Manialink\Rendering;

use ManiaLib\Manialink\Node;

interface RendererInterface
{

	function setRoot(Node $node);

	function getXML();
}
