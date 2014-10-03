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
    
    /**
     * @return static
     */
    function setClip($clip = 1) {
        return $this->setAttribute('clip', $clip);
    }
    
    function getClip() {
        return $this->getAttribute('clip');
    }
    
    function getClipPosn()
    {
        $posn = explode(' ', $this->getAttribute('clipposn', '0 0'));
        if (count($posn) != 2) {
            throw new Exception('ClipPosn should be a 2-element array');
        }
        return $posn;
    }

    function getClipPosnX()
    {
        $posn = $this->getClipPosn();
        return $posn[0];
    }

    function getClipPosnY()
    {
        $posn = $this->getClipPosn();
        return $posn[1];
    }

    /**
     * @return static
     */
    function setClipPosn($posnX = null, $posnY = null)
    {
        $posnX = $posnX === null ? $this->getClipPosnX() : $posnX;
        $posnY = $posnY === null ? $this->getClipPosnY() : $posnY;
        return $this->setAttribute('clipposn', (float)$posnX . ' ' . (float)$posnY);
    }

    /**
     * @return static
     */
    function setClipPosnX($posnX)
    {
        return $this->setClipPosn($posnX, null);
    }

    /**
     * @return static
     */
    function setClipPosnY($posnY)
    {
        return $this->setClipPosn(null, $posnY);
    }
    
    function getClipSizen()
    {
        $posn = explode(' ', $this->getAttribute('clipsizen', '0 0'));
        if (count($posn) != 2) {
            throw new Exception('ClipSizen should be a 2-element array');
        }
        return $posn;
    }

    function getClipSizenX()
    {
        $posn = $this->getClipSizen();
        return $posn[0];
    }

    function getClipSizenY()
    {
        $posn = $this->getClipSizen();
        return $posn[1];
    }

    /**
     * @return static
     */
    function setClipSizen($posnX = null, $posnY = null)
    {
        $posnX = $posnX === null ? $this->getClipSizenX() : $posnX;
        $posnY = $posnY === null ? $this->getClipSizenY() : $posnY;
        return $this->setAttribute('clipsizen', (float)$posnX . ' ' . (float)$posnY);
    }

    /**
     * @return static
     */
    function setClipSizenX($posnX)
    {
        return $this->setClipSizen($posnX, null);
    }

    /**
     * @return static
     */
    function setClipSizenY($posnY)
    {
        return $this->setClipSizen(null, $posnY);
    }


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
