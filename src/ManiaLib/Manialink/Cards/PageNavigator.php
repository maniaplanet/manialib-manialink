<?php
/**
 * @version     $Revision: $:
 * @author      $Author: $:
 * @date        $Date: $:
 */

namespace ManiaLib\Manialink\Cards;

use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\Manialink\Elements\Label;

class PageNavigator extends \ManiaLib\Manialink\Elements\Frame
{
	/**
	 * @var Quad
	 */
	public $arrowNext;

	/**
	 * @var Quad
	 */
	public $arrowPrev;

	/**
	 * @var Quad
	 */
	public $arrowFastNext;

	/**
	 * @var Quad
	 */
	public $arrowFastPrev;

	/**
	 * @var Quad
	 */
	public $arrowLast;

	/**
	 * @var Quad
	 */
	public $arrowFirst;

	/**
	 * @var Label
	 */
	public $text;

	/**
	 * @var Quad
	 */
	public $textBg;

	public $arrowNoneStyle = 'Icons64x64_1:ArrowDisabled';
	public $arrowNextStyle = 'Icons64x64_1:ArrowNext';
	public $arrowPrevStyle = 'Icons64x64_1:ArrowPrev';
	public $arrowFastNextStyle = 'Icons64x64_1:ArrowFastNext';
	public $arrowFastPrevStyle = 'Icons64x64_1:ArrowFastPrev';
	public $arrowFirstStyle = 'Icons64x64_1:ArrowFirst';
	public $arrowLastStyle = 'Icons64x64_1:ArrowLast';

	protected $showLast;
	protected $showFastNext;
	protected $showText;
	protected $pageNumber;
	protected $currentPage;

	function __construct($iconSize = 8)
	{
		parent::__construct();

		$this->arrowFastNext = Quad::create()
				->setSizen(8, 8);
		$this->arrowFastPrev = Quad::create()
				->setSizen(8, 8);
		$this->arrowFirst = Quad::create()
				->setSizen(8, 8);
		$this->arrowLast = Quad::create()
				->setSizen(8, 8);
		$this->arrowPrev = Quad::create()
				->setSizen(8, 8);
		$this->arrowNext = Quad::create()
				->setSizen(8, 8);
		$this->text = Label::create();
		$this->textBg = Quad::create();

		$this->registerCallback(self::EVENT_PREFILTER, array($this, 'preFilter'));
	}

	/**
	 * Sets the page number
	 */
	function setPageNumber($pageNumber)
	{
		$this->pageNumber = $pageNumber;
	}

	/**
	 * Sets the current page
	 */
	function setCurrentPage($currentPage)
	{
		$this->currentPage = $currentPage;
	}

	/**
	 * Shows or hides the "go to first/last" navigation icons
	 */
	function showLast($show = true)
	{
		$this->showLast = $show;
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
	 */
	function showFastNext($show = true)
	{
		$this->showFastNext = $show;
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
	 */
	function showText($show = true)
	{
		$this->showText = $show;
	}

	/**
	 * Returns whether the text is shown
	 */
	function isTextShown()
	{
		return $this->showText;
	}

	/**
	 * Cloning behaviour: if you clone this, it also clones sub-Elements
	 */
	function __clone()
	{
		$this->registerCallback(self::EVENT_PREFILTER, array($this, 'preFilter'));
		foreach($this as $name => $property)
		{
			if($property instanceof \ManiaLib\Manialink\Node)
			{
				$this->$name = clone $property;
			}
		}
	}

	function preFilter()
	{
		// Set styles
		$this->arrowFastNext->setStyle($this->arrowNoneStyle);
		$this->arrowFastPrev->setStyle($this->arrowNoneStyle);
		$this->arrowFirst->setStyle($this->arrowNoneStyle);
		$this->arrowLast->setStyle($this->arrowLastStyle);
		$this->arrowPrev->setStyle($this->arrowNoneStyle);
		$this->arrowNext->setStyle($this->arrowNoneStyle);

		// Arrow styles
		if($this->arrowNext->hasLink())
		{
			$this->arrowNext->setStyle($this->arrowNextStyle);
		}
		if($this->arrowPrev->hasLink())
		{
			$this->arrowPrev->setStyle($this->arrowPrevStyle);
		}
		if($this->arrowNext->hasLink() && $this->arrowFastNext->hasLink())
		{
			$this->arrowFastNext->setStyle($this->arrowFastNextStyle);
		}
		else
		{
			$this->arrowFastNext->setManialink(null);
		}
		if($this->arrowPrev->hasLink() && $this->arrowFastPrev->hasLink())
		{
			$this->arrowFastPrev->setStyle($this->arrowFastPrevStyle);
		}
		else
		{
			$this->arrowFastPrev->setManialink(null);
		}
		if($this->arrowNext->hasLink() && $this->arrowLast->hasLink())
		{
			$this->arrowLast->setStyle($this->arrowLastStyle);
		}
		else
		{
			$this->arrowLast->setManialink(null);
		}
		if($this->arrowPrev->hasLink() && $this->arrowFirst->hasLink())
		{
			$this->arrowFirst->setStyle($this->arrowFirstStyle);
		}
		else
		{
			$this->arrowFirst->setManialink(null);
		}

		$this->text->setText($this->currentPage.' / '.$this->pageNumber);
		$this->text->setAlign('center', 'center2');
		$this->text->setPosnZ(0.1);

		$this->arrowNext->setValign("center");
		$this->arrowFastNext->setValign("center");
		$this->arrowLast->setValign("center");

		$this->arrowNext->setPosn(($this->text->getSizenX() / 2) + 1, 0, 1);
		$this->arrowFastNext->setPosn($this->arrowNext->getPosnX() + $this->arrowNext->getSizenX(), 0, 1);
		$this->arrowLast->setPosn(
			$this->arrowNext->getPosnX() +
			(int) $this->showFastNext * $this->arrowFastNext->getSizenX() +
			$this->arrowNext->getSizenX(), 0, 1);

		$this->arrowPrev->setAlign("right", "center");
		$this->arrowFastPrev->setAlign("right", "center");
		$this->arrowFirst->setAlign("right", "center");

		$this->arrowPrev->setPosn(-($this->text->getSizenX() / 2) - 1, 0, 1);
		$this->arrowFastPrev->setPosn($this->arrowPrev->getPosnX() - $this->arrowPrev->getSizenX(), 0, 1);
		$this->arrowFirst->setPosn(
			$this->arrowPrev->getPosnX() -
			(int) $this->showFastNext * $this->arrowFastPrev->getSizenX() -
			$this->arrowPrev->getSizenX(), 0, 1);

		if ($this->showText)
		{
			$this->appendChild($this->text);
			$this->appendChild($this->textBg);
		}
		if ($this->showFastNext)
		{
			$this->appendChild($this->arrowFastNext);
			$this->appendChild($this->arrowFastPrev);
		}
		if ($this->showLast)
		{
			$this->appendChild($this->arrowFirst);
			$this->appendChild($this->arrowLast);
		}
		$this->appendChild($this->arrowPrev);
		$this->appendChild($this->arrowNext);
	}
}

