<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\Manialink\Exception;
use ManiaLib\Manialink\Layouts\AbstractLayout;
use ManiaLib\Manialink\Utils;
use ManiaLib\XML\Node;
use ManiaLib\XML\Rendering\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class Base extends Node
{

    protected $posnX;
    protected $posnY;
    protected $posnZ;
    protected $sizenX;
    protected $sizenY;

    function registerListeners(EventDispatcherInterface $dispatcher)
    {
        parent::registerListeners($dispatcher);

        // Pre-render filters
        $dispatcher->addListener(Events::preRender($this), array($this, 'preFilterLayout'));
        $dispatcher->addListener(Events::preRender($this), array($this, 'preFilterRelativePosition'));
        $dispatcher->addListener(Events::preRender($this), array($this, 'preFilterPosition'));
        $dispatcher->addListener(Events::preRender($this), array($this, 'preFilterSize'));

        // Post-render filters
        $dispatcher->addListener(Events::postRender($this), array($this, 'postFilterLayout'));
    }

    public function preFilterPosition()
    {
        if (!$this->attributeExists('posn')) {
            if ($this->posnX !== null || $this->posnY !== null || $this->posnZ !== null) {

                $this->setAttribute('posn', (float)$this->posnX . ' ' . (float)$this->posnY . ' ' . (float)$this->posnZ);
            }
        }
    }

    public function preFilterSize()
    {
        
    }

    public function preFilterLayout()
    {
        if ($this->getParent() instanceof Frame && $this->getParent()->getLayout() instanceof AbstractLayout) {
            $this->getParent()->getLayout()->preFilter($this);
            $this->getParent()->getLayout()->updateChild($this);
        }
    }

    public function postFilterLayout()
    {
        if ($this->getParent() instanceof Frame && $this->getParent()->getLayout() instanceof AbstractLayout) {
            $this->getParent()->getLayout()->postFilter($this);
        }
    }

    public function preFilterRelativePosition()
    {
        if ($this->getParent() instanceof Base) {
            if ($this->getRelativeHalign()) {
                $sizeX      = $this->getParent()->getSizenX();
                $halign     = $this->getParent()->getHalign();
                $xIncrement = Utils::getAlignedPosX(0, $sizeX, $halign, $this->getRelativeHalign());
                $this->setPosnX($this->getPosnX() + $xIncrement);
                $this->deleteAttribute('relativehalign');
            }
            if ($this->getRelativeValign()) {
                $sizeY      = $this->getParent()->getSizenY();
                $valign     = $this->getParent()->getValign();
                $yIncrement = Utils::getAlignedPosY(0, $sizeY, $valign, $this->getRelativeValign());
                $this->setPosnY($this->getPosnY() + $yIncrement);
                $this->deleteAttribute('relativevalign');
            }
        }
        // TODO Good idea?
        elseif ($this->getParent() instanceof Manialink) {
            if ($this->getRelativeHalign()) {
                $sizeX      = 320;
                $halign     = 'center';
                $xIncrement = Utils::getAlignedPosX(0, $sizeX, $halign, $this->getRelativeHalign());
                $this->setPosnX($this->getPosnX() + $xIncrement);
                $this->deleteAttribute('relativehalign');
            }
            if ($this->getRelativeValign()) {
                $sizeY      = 180;
                $valign     = 'center';
                $yIncrement = Utils::getAlignedPosY(0, $sizeY, $valign, $this->getRelativeValign());
                $this->setPosnY($this->getPosnY() + $yIncrement);
                $this->deleteAttribute('relativevalign');
            }
        }
    }

    function getSizen()
    {
        $sizen = explode(' ', $this->getAttribute('sizen', '0 0'));
        if (count($sizen) != 2) {
            throw new Exception('Sizen should be a 2-element array');
        }
        return $sizen;
    }

    function getSizenX()
    {
        return reset($this->getSizen());
    }

    function getSizenY()
    {
        return end($this->getSizen());
    }

    function getRealSizenX()
    {
        if (!$this->attributeExists('sizen')) {
            throw new Exception('SizenX is not set');
        }
        return $this->getSizenX() * $this->getAttribute("scale", 1);
    }

    function getRealSizenY()
    {
        if (!$this->attributeExists('sizen')) {
            throw new Exception('SizenY is not set');
        }
        return $this->getSizenY() * $this->getAttribute("scale", 1);
    }

    /**
     * @return \static
     */
    function setSizen($sizenX = null, $sizenY = null)
    {
        $sizenX = (float)$sizenX !== null ? $sizenX : $this->getSizenX();
        $sizenY = (float)$sizenY !== null ? $sizenY : $this->getSizenY();
        return $this->setAttribute('sizen', (float)$sizenX . ' ' . (float)$sizenY);
    }

    /**
     * @return \static
     */
    function setSizenX($sizenX)
    {
        return $this->setSizen($sizenX, null);
    }

    /**
     * @return \static
     */
    function setSizenY($sizenY)
    {
        return $this->setSizen(null, $sizenY);
    }

    /**
     * @return \static
     */
    function setPosn($posnX = null, $posnY = null, $posnZ = null)
    {
        if ($posnX !== null) {
            $this->setPosnX($posnX);
        }
        if ($posnY !== null) {
            $this->setPosnY($posnY);
        }
        if ($posnZ !== null) {
            $this->setPosnZ($posnZ);
        }
        return $this;
    }

    /**
     * @return \static
     */
    function setPosnX($posnX)
    {
        $this->posnX = $posnX;
        return $this;
    }

    /**
     * @return \static
     */
    function setPosnY($posnY)
    {
        $this->posnY = $posnY;
        return $this;
    }

    /**
     * @return \static
     */
    function setPosnZ($posnZ)
    {
        $this->posnZ = $posnZ;
        return $this;
    }

    function getPosnX()
    {
        return $this->posnX;
    }

    function getPosnY()
    {
        return $this->posnY;
    }

    function getPosnZ()
    {
        return $this->posnZ;
    }

    /**
     * @return \static
     */
    function setAlign($halign = null, $valign = null)
    {
        if ($halign !== null) {
            $this->setHalign($halign);
        }
        if ($valign !== null) {
            $this->setValign($valign);
        }
        return $this;
    }

    /**
     * @return \static
     */
    function setRelativeHalign($halign)
    {
        return $this->setAttribute('relativehalign', $halign);
    }

    function getRelativeHalign()
    {
        return $this->getAttribute('relativehalign');
    }

    /**
     * @return \static
     */
    function setRelativeValign($valign)
    {
        return $this->setAttribute('relativevalign', $valign);
    }

    function getRelativeValign()
    {
        return $this->getAttribute('relativevalign');
    }

    /**
     * @return \static
     */
    function setRelativeAlign($halign = null, $valign = null)
    {
        if ($halign !== null) {
            $this->setRelativeHalign($halign);
        }
        if ($valign !== null) {
            $this->setRelativeValign($valign);
        }
        return $this;
    }

    /**
     * @return \static
     */
    function setBothHalign($halign)
    {
        return $this->setHalign($halign)->setRelativeHalign($halign);
    }

    /**
     * @return \static
     */
    function setBothValign($valign)
    {
        return $this->setValign($valign)->setRelativeValign($valign);
    }

    /**
     * @return \static
     */
    function setBothAlign($halign = null, $valign = null)
    {
        return $this->setAlign($halign, $valign)->setRelativeAlign($halign, $valign);
    }

    /**
     * @return \static
     */
    function setStyle($style)
    {
        $explodedStyle = explode(':', $style);
        if (count($explodedStyle) == 2) {
            list($_style, $_substyle) = $explodedStyle;
            return $this->setAttribute('style', $_style)->setAttribute('substyle', $_substyle);
        } else {
            return $this->setAttribute('style', $style);
        }
    }

    function getStyle()
    {
        return $this->getAttribute("style");
    }

    function getSubstyle()
    {
        return $this->getAttribute("substyle");
    }

    /**
     * Below this: code gen
     */

    /**
     * @return \static
     */
    function setId($id)
    {
        return $this->setAttribute("id", $id);
    }

    function getId()
    {
        return $this->getAttribute("id");
    }

    /**
     * @return \static
     */
    function setClass($class)
    {
        return $this->setAttribute("class", $class);
    }

    function getClass()
    {
        return $this->getAttribute("class");
    }

    /**
     * @return \static
     */
    function setHidden($hidden)
    {
        return $this->setAttribute("hidden", $hidden);
    }

    function getHidden()
    {
        return $this->getAttribute("hidden");
    }

    /**
     * @return \static
     */
    function setScale($scale)
    {
        return $this->setAttribute("scale", $scale);
    }

    function getScale()
    {
        return $this->getAttribute("scale");
    }

    /**
     * @return \static
     */
    function setHalign($halign)
    {
        return $this->setAttribute("halign", $halign);
    }

    function getHalign()
    {
        return $this->getAttribute("halign");
    }

    /**
     * @return \static
     */
    function setValign($valign)
    {
        return $this->setAttribute("valign", $valign);
    }

    function getValign()
    {
        return $this->getAttribute("valign");
    }

    /**
     * @return \static
     */
    function setManialink($manialink)
    {
        return $this->setAttribute("manialink", $manialink);
    }

    function getManialink()
    {
        return $this->getAttribute("manialink");
    }

    /**
     * @return \static
     */
    function setManiazone($maniazone)
    {
        return $this->setAttribute("maniazone", $maniazone);
    }

    function getManiazone()
    {
        return $this->getAttribute("maniazone");
    }

    /**
     * @return \static
     */
    function setGoto($goto)
    {
        return $this->setAttribute("goto", $goto);
    }

    function getGoto()
    {
        return $this->getAttribute("goto");
    }

    /**
     * @return \static
     */
    function setUrl($url)
    {
        return $this->setAttribute("url", $url);
    }

    function getUrl()
    {
        return $this->getAttribute("url");
    }

    /**
     * @return \static
     */
    function setAction($action)
    {
        return $this->setAttribute("action", $action);
    }

    function getAction()
    {
        return $this->getAttribute("action");
    }

    /**
     * @return \static
     */
    function setScriptevents($scriptevents = 1)
    {
        return $this->setAttribute("scriptevents", $scriptevents);
    }

    function getScriptevents()
    {
        return $this->getAttribute("scriptevents");
    }

    /**
     * @return \static
     */
    function setColorize($colorize)
    {
        return $this->setAttribute("colorize", $colorize);
    }

    function getColorize()
    {
        return $this->getAttribute("colorize");
    }

    /**
     * @return \static
     */
    function setModulatecolor($modulatecolor)
    {
        return $this->setAttribute('modulatecolor', $modulatecolor);
    }

    function getModulatecolor()
    {
        return $this->getAttribute("modulatecolor");
    }

    /**
     * @return \static
     */
    function setOpacity($opacity)
    {
        return $this->setAttribute("opacity", $opacity);
    }

    function getOpacity()
    {
        return $this->getAttribute("opacity");
    }

    function hasLink()
    {
        return
            $this->getAttribute('manialink') !== null ||
            $this->getAttribute('url') !== null ||
            $this->getAttribute('action') !== null ||
            $this->getAttribute('maniazone') !== null ||
            $this->getAttribute('scriptevents') !== null;
    }

}
