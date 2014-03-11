<?php

namespace ManiaLib\Manialink\Rendering;

interface DriverInterface
{

	function getXML(\ManiaLib\Manialink\Node $root);

	function appendXML($xml);
}
