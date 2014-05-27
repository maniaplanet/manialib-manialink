<?php

namespace ManiaLib\Manialink\Cards;

use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Quad;

class Box extends Frame
{

    /**
     * @var Quad
     */
    protected $bg;

    function __construct()
    {
        $this->bg = Quad::create()->appendTo($this);
    }

    public function preFilterSize()
    {
        parent::preFilterSize();
        $this->bg->setSizen($this->getSizenX(), $this->getSizenY());
    }

    /**
     * @return Quad
     */
    function getBg()
    {
        return $this->bg;
    }

}
