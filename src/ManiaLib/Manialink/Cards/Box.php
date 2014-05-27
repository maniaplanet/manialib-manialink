<?php

namespace ManiaLib\Manialink\Cards;

use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\XML\Rendering\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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

    function registerListeners(EventDispatcherInterface $dispatcher)
    {
        parent::registerListeners($dispatcher);
        $dispatcher->addListener(Events::preRender($this), array($this, 'preFilterSize'));
    }

    public function preFilterSize()
    {
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
