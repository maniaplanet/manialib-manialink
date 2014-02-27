<?php

namespace ManiaLib\Manialink;

class Leaf extends \ManiaLib\Manialink\Node
{

	function addChild(Node $child)
	{
		throw new Exception(sprintf('Cannot add a child to %s', get_called_class()));
	}

}
