<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\XML\Node;

class Manialink extends Node
{

    const BG_DEFAULT          = 1;
    const BG_HIDDEN           = 0;
    const BG_STARS            = 'stars';
    const BG_STATIONS         = 'stations';
    const BG_TITLE            = 'title';

    protected $nodeName = 'manialink';

    function __construct()
    {
        $this->setVersion(1);
    }

    /**
     * @return \static
     */
    function setVersion($value)
    {
        return $this->setAttribute('version', $value);
    }

    /**
     * @return \static
     */
    function setBackground($value)
    {
        return $this->setAttribute('background', $value);
    }

    /**
     * @return \static
     */
    function setNavigable3d($value)
    {
        return $this->setAttribute('navigable3d', $value);
    }

}
