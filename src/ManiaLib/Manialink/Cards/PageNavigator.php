<?php
/**
 * @version     $Revision: $:
 * @author      $Author: $:
 * @date        $Date: $:
 */

namespace ManiaLib\Manialink\Cards;

use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Label;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\XML\Rendering\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PageNavigator extends Frame
{

    /**
     * @var Quad
     */
    protected $arrowNext;

    /**
     * @var Quad
     */
    protected $arrowPrev;

    /**
     * @var Quad
     */
    protected $arrowFastNext;

    /**
     * @var Quad
     */
    protected $arrowFastPrev;

    /**
     * @var Quad
     */
    protected $arrowLast;

    /**
     * @var Quad
     */
    protected $arrowFirst;

    /**
     * @var Label
     */
    protected $text;

    /**
     * @var Quad
     */
    protected $textBg;
    protected $arrowNoneStyle     = 'Icons64x64_1:ArrowDisabled';
    protected $arrowNextStyle     = 'Icons64x64_1:ArrowNext';
    protected $arrowPrevStyle     = 'Icons64x64_1:ArrowPrev';
    protected $arrowFastNextStyle = 'Icons64x64_1:ArrowFastNext';
    protected $arrowFastPrevStyle = 'Icons64x64_1:ArrowFastPrev';
    protected $arrowFirstStyle    = 'Icons64x64_1:ArrowFirst';
    protected $arrowLastStyle     = 'Icons64x64_1:ArrowLast';
    protected $showLast;
    protected $showFastNext;
    protected $showText;
    protected $pageNumber;
    protected $currentPage;

    function __construct()
    {
        $this->arrowFastNext = Quad::create()
            ->setSizen(8, 8);
        $this->arrowFastPrev = Quad::create()
            ->setSizen(8, 8);
        $this->arrowFirst    = Quad::create()
            ->setSizen(8, 8);
        $this->arrowLast     = Quad::create()
            ->setSizen(8, 8);
        $this->arrowPrev     = Quad::create()
            ->setSizen(8, 8);
        $this->arrowNext     = Quad::create()
            ->setSizen(8, 8);
        $this->text          = Label::create()
            ->setSizen(14);
        $this->textBg        = Quad::create()
            ->setSizen(16, 6);
    }

    function registerListeners(EventDispatcherInterface $dispatcher)
    {
        parent::registerListeners($dispatcher);
        $dispatcher->addListener(Events::preRender($this), array($this, 'preFilter'));
    }

    /**
     * @return Quad
     */
    public function getArrowNext()
    {
        return $this->arrowNext;
    }

    /**
     * @return Quad
     */
    public function getArrowPrev()
    {
        return $this->arrowPrev;
    }

    /**
     * @return Quad
     */
    public function getArrowFastNext()
    {
        return $this->arrowFastNext;
    }

    /**
     * @return Quad
     */
    public function getArrowFastPrev()
    {
        return $this->arrowFastPrev;
    }

    /**
     * @return Quad
     */
    public function getArrowFirst()
    {
        return $this->arrowFirst;
    }

    /**
     * @return Quad
     */
    public function getArrowLast()
    {
        return $this->arrowLast;
    }

    /**
     * @return string
     */
    public function getArrowNoneStyle()
    {
        return $this->arrowNoneStyle;
    }

    /**
     * @param string $style
     * @return \static
     */
    public function setArrowNoneStyle($style)
    {
        $this->arrowNoneStyle = $style;
        return $this;
    }

    /**
     * @return string
     */
    public function getArrowPrevStyle()
    {
        return $this->arrowPrevStyle;
    }

    /**
     * @param string $style
     * @return \static
     */
    public function setArrowPrevStyle($style)
    {
        $this->arrowPrevStyle = $style;
        return $this;
    }

    /**
     * @return string
     */
    public function getArrowNextStyle()
    {
        return $this->arrowNextStyle;
    }

    /**
     * @param string $style
     * @return \static
     */
    public function setArrowNextStyle($style)
    {
        $this->arrowNextStyle = $style;
        return $this;
    }

    /**
     * @return string
     */
    public function getArrowFastNextStyle()
    {
        return $this->arrowFastNextStyle;
    }

    /**
     * @param string $style
     * @return \static
     */
    public function setArrowFastNextStyle($style)
    {
        $this->arrowFastNextStyle = $style;
        return $this;
    }

    /**
     * @return string
     */
    public function getArrowFastPrevStyle()
    {
        return $this->arrowFastPrevStyle;
    }

    /**
     * @param string $style
     * @return \static
     */
    public function setArrowFastPrevStyle($style)
    {
        $this->arrowFastPrev = $style;
        return $this;
    }

    /**
     * @return string
     */
    public function getArrowFirstStyle()
    {
        return $this->arrowFirstStyle;
    }

    /**
     * @param string $style
     * @return \static
     */
    public function setArrowFirstStyle($style)
    {
        $this->arrowFirstStyle = $style;
        return $this;
    }

    /**
     * @return string
     */
    public function getArrowLastStyle()
    {
        return $this->arrowLastStyle;
    }

    /**
     * @param string $style
     * @return \static
     */
    public function setArrowLastStyle($style)
    {
        $this->arrowLastStyle = $style;
        return $this;
    }

    /**
     * Sets the page number
     * @return \static
     */
    function setPageNumber($pageNumber)
    {
        $this->pageNumber = $pageNumber;
        return $this;
    }

    /**
     * Sets the current page
     * @return \static
     */
    function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * Shows or hides the "go to first/last" navigation icons
     * @return \static
     */
    function showLast($show = true)
    {
        $this->showLast = $show;
        return $this;
    }

    /**
     * Returns whether the "go to first/last" navigation icons are shown
     */
    function isLastShown()
    {
        return $this->showLast;
    }

    /**
     * Shows or hides the "fast prev/next" navigation icons
     * @return \static
     */
    function showFastNext($show = true)
    {
        $this->showFastNext = $show;
        return $this;
    }

    /**
     * Returns whether the "fast prev/next" navigation icons are shown
     */
    function isFastNextShown()
    {
        return $this->showFastNext;
    }

    /**
     * Shows or hides the text. Note that if the current page or the page number
     * isn't declared, the text won't be shown
     * @return \static
     */
    function showText($show = true)
    {
        $this->showText = $show;
        return $this;
    }

    /**
     * Returns whether the text is shown
     */
    function isTextShown()
    {
        return $this->showText;
    }

    function preFilter()
    {
        // Set styles
        $this->arrowFastNext->setStyle($this->arrowNoneStyle);
        $this->arrowFastPrev->setStyle($this->arrowNoneStyle);
        $this->arrowFirst->setStyle($this->arrowNoneStyle);
        $this->arrowLast->setStyle($this->arrowNoneStyle);
        $this->arrowPrev->setStyle($this->arrowNoneStyle);
        $this->arrowNext->setStyle($this->arrowNoneStyle);

        // Arrow styles
        if ($this->arrowNext->hasLink()) {
            $this->arrowNext->setStyle($this->arrowNextStyle);
        }
        if ($this->arrowPrev->hasLink()) {
            $this->arrowPrev->setStyle($this->arrowPrevStyle);
        }
        if ($this->arrowNext->hasLink() && $this->arrowFastNext->hasLink()) {
            $this->arrowFastNext->setStyle($this->arrowFastNextStyle);
        } else {
            $this->arrowFastNext->setManialink(null);
        }
        if ($this->arrowPrev->hasLink() && $this->arrowFastPrev->hasLink()) {
            $this->arrowFastPrev->setStyle($this->arrowFastPrevStyle);
        } else {
            $this->arrowFastPrev->setManialink(null);
        }
        if ($this->arrowNext->hasLink() && $this->arrowLast->hasLink()) {
            $this->arrowLast->setStyle($this->arrowLastStyle);
        } else {
            $this->arrowLast->setManialink(null);
        }
        if ($this->arrowPrev->hasLink() && $this->arrowFirst->hasLink()) {
            $this->arrowFirst->setStyle($this->arrowFirstStyle);
        } else {
            $this->arrowFirst->setManialink(null);
        }

        $this->text->setText($this->currentPage . ' / ' . $this->pageNumber);
        $this->text->setAlign('center', 'center2');
        $this->text->setRelativeAlign('center', 'center');
        $this->text->setPosnZ(0.1);

        $this->textBg->setBothAlign('center', 'center');

        $this->arrowNext->setRelativeAlign('center', 'center')->setValign("center");
        $this->arrowFastNext->setRelativeAlign('center', 'center')->setValign("center");
        $this->arrowLast->setRelativeAlign('center', 'center')->setValign("center");

        $this->arrowNext->setPosn(((int)$this->showText * $this->text->getSizenX() / 2), 0, 1);
        $this->arrowFastNext->setPosn($this->arrowNext->getPosnX() + $this->arrowNext->getSizenX(), 0, 1);
        $this->arrowLast->setPosn(
            $this->arrowNext->getPosnX() +
            (int)$this->showFastNext * $this->arrowFastNext->getSizenX() +
            $this->arrowNext->getSizenX(), 0, 1);

        $this->arrowPrev->setRelativeAlign('center', 'center')->setAlign("right", "center");
        $this->arrowFastPrev->setRelativeAlign('center', 'center')->setAlign("right", "center");
        $this->arrowFirst->setRelativeAlign('center', 'center')->setAlign("right", "center");

        $this->arrowPrev->setPosn(-((int)$this->showText * $this->text->getSizenX() / 2), 0, 1);
        $this->arrowFastPrev->setPosn($this->arrowPrev->getPosnX() - $this->arrowPrev->getSizenX(), 0, 1);
        $this->arrowFirst->setPosn(
            $this->arrowPrev->getPosnX() -
            (int)$this->showFastNext * $this->arrowFastPrev->getSizenX() -
            $this->arrowPrev->getSizenX(), 0, 1);

        if ($this->showText) {
            $this->appendChild($this->text);
            $this->appendChild($this->textBg);
        }
        if ($this->showFastNext) {
            $this->appendChild($this->arrowFastNext);
            $this->appendChild($this->arrowFastPrev);
        }
        if ($this->showLast) {
            $this->appendChild($this->arrowFirst);
            $this->appendChild($this->arrowLast);
        }
        $this->appendChild($this->arrowPrev);
        $this->appendChild($this->arrowNext);
    }

}
