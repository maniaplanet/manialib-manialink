<?php

namespace ManiaLib\XML\Rendering;

interface DriverInterface
{

	function getXML(\ManiaLib\XML\Node $root);

	function appendXML($xml);
}
