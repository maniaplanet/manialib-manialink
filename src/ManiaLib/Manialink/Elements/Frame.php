<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\Manialink\Layouts\AbstractLayout;
use ManiaLib\Manialink\Utils;
use ManiaLib\XML\Rendering\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Frame extends Base
{

    protected $nodeName = 'frame';

    /**
     * @var AbstractLayout
     */
    protected $layout;

    function registerListeners(EventDispatcherInterface $dispatcher)
    {
        $dispatcher->addListener(Events::preRender($this), array($this, 'preFilterAlign'));
        parent::registerListeners($dispatcher);
    }

    function __clone()
    {
        parent::__clone();
        if ($this->layout instanceof AbstractLayout) {
            $this->layout = clone $this->layout;
        }
    }

    public function preFilterSize()
    {
        // Override parent. Do nothing.
    }

    public function preFilterAlign()
    {
        $halign = $this->getHalign();
        $valign = $this->getValign();
        if ($halign) {
            $this->setPosnX(Utils::getAlignedPosX($this->getPosnX(), $this->getRealSizenX(), $halign, "left"));
            $this->deleteAttribute('halign');
        }
        if ($valign) {
            $this->setPosnY(Utils::getAlignedPosY($this->getPosnY(), $this->getRealSizenY(), $valign, "top"));
            $this->deleteAttribute('valign');
        }
    }

    /**
     * @return AbstractLayout
     */
    function getLayout()
    {
        return $this->layout;
    }

    /**
     * @return \static
     */
    function setLayout(AbstractLayout $layout)
    {
        $this->layout = $layout->setParent($this);
        return $this;
    }

}
