<?php

namespace ManiaLib\Manialink\Layouts;

class Line extends AbstractLayout
{

    function preFilter(\ManiaLib\Manialink\Elements\Base $node)
    {
        
    }

    function postFilter(\ManiaLib\Manialink\Elements\Base $node)
    {
        $this->xIndex += $node->getRealSizenX() + $this->marginWidth;
    }

}
