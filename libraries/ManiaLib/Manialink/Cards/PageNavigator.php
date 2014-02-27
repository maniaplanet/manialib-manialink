<?php
/**
 * ManiaLib - Lightweight PHP framework for Manialinks
 *
 * @see         http://code.google.com/p/manialib/
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision$:
 * @author      $Author$:
 * @date        $Date$:
 */

namespace ManiaLib\Manialink\Cards;

/**
 * Page navigation arrows at the bottom of the lists
 */
class PageNavigator extends \ManiaLib\Manialink\Elements\Frame
{

	/**
	 * @var \ManiaLib\Manialink\Elements\Icons64x64_1
	 */
	public $arrowNext;

	/**
	 * @var \ManiaLib\Manialink\Elements\Icons64x64_1
	 */
	public $arrowPrev;

	/**
	 * @var \ManiaLib\Manialink\Elements\Icons64x64_1
	 */
	public $arrowFastNext;

	/**
	 * @var \ManiaLib\Manialink\Elements\Icons64x64_1
	 */
	public $arrowFastPrev;

	/**
	 * @var \ManiaLib\Manialink\Elements\Icons64x64_1
	 */
	public $arrowLast;

	/**
	 * @var \ManiaLib\Manialink\Elements\Icons64x64_1
	 */
	public $arrowFirst;

	/**
	 * @var \ManiaLib\Manialink\Elements\Label
	 */
	public $text;

	/**
	 * @var \ManiaLib\Manialink\Elements\Bgs1
	 */
	public $textBg;
	public $arrowNoneStyle = \ManiaLib\Manialink\Elements\Icons64x64_1::ArrowDisabled;
	public $arrowNextStyle = \ManiaLib\Manialink\Elements\Icons64x64_1::ArrowNext;
	public $arrowPrevStyle = \ManiaLib\Manialink\Elements\Icons64x64_1::ArrowPrev;
	public $arrowFastNextStyle = \ManiaLib\Manialink\Elements\Icons64x64_1::ArrowFastNext;
	public $arrowFastPrevStyle = \ManiaLib\Manialink\Elements\Icons64x64_1::ArrowFastPrev;
	public $arrowFirstStyle = \ManiaLib\Manialink\Elements\Icons64x64_1::ArrowFirst;
	public $arrowLastStyle = \ManiaLib\Manialink\Elements\Icons64x64_1::ArrowLast;

	/*	 * #@+
	 * @ignore
	 */
	protected $showLast;
	protected $showFastNext;
	protected $showText;
	protected $pageNumber;
	protected $currentPage;
	/*	 * #@- */

	function __construct($iconSize = 8)
	{
		parent::__construct();

		$this->arrowNext = new \ManiaLib\Manialink\Elements\Icons64x64_1($iconSize);
		$this->arrowPrev = new \ManiaLib\Manialink\Elements\Icons64x64_1($iconSize);
		$this->arrowFastNext = new \ManiaLib\Manialink\Elements\Icons64x64_1($iconSize);
		$this->arrowFastPrev = new \ManiaLib\Manialink\Elements\Icons64x64_1($iconSize);
		$this->arrowLast = new \ManiaLib\Manialink\Elements\Icons64x64_1($iconSize);
		$this->arrowFirst = new \ManiaLib\Manialink\Elements\Icons64x64_1($iconSize);
		$this->text = new \ManiaLib\Manialink\Elements\Label(14);
		$this->textBg = new \ManiaLib\Manialink\Elements\Bgs1(16, $iconSize - 2);

		$this->showLast = false;
		$this->showFastNext = false;
		$this->showText = true;

		$this->arrowNext->setSubStyle($this->arrowNoneStyle);
		$this->arrowPrev->setSubStyle($this->arrowNoneStyle);
		$this->arrowFastNext->setSubStyle($this->arrowNoneStyle);
		$this->arrowFastPrev->setSubStyle($this->arrowNoneStyle);
		$this->arrowLast->setSubStyle($this->arrowNoneStyle);
		$this->arrowFirst->setSubStyle($this->arrowNoneStyle);
	}

	/**
	 * Cloning behaviour: if you clone this, it also clones sub-Elements
	 */
	function __clone()
	{
		foreach($this as $name => $property)
		{
			if($property instanceof \ManiaLib\Manialink\Element)
			{
				$this->$name = clone $property;
			}
		}
	}

	/**
	 * Sets the size of the navigation icons
	 */
	function setSize($iconSize = 5, $nullValue = null)
	{
		$this->arrowNext->setSize($iconSize, $iconSize);
		$this->arrowPrev->setSize($iconSize, $iconSize);
		$this->arrowFastNext->setSize($iconSize, $iconSize);
		$this->arrowFastPrev->setSize($iconSize, $iconSize);
		$this->arrowLast->setSize($iconSize, $iconSize);
		$this->arrowFirst->setSize($iconSize, $iconSize);
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
	 * Saves the PageNavigator in the GUI objects stack
	 */
	function preFilter()
	{
		// Show / hide text
		if(!$this->currentPage || !$this->pageNumber)
		{
			$this->showText(false);
		}

		// Auto show fast next / last
		if($this->arrowFirst->hasLink() || $this->arrowLast->hasLink())
		{
			$this->showLast();
		}
		if($this->arrowFastNext->hasLink() || $this->arrowFastPrev->hasLink())
		{
			$this->showFastNext();
		}

		// Arrow styles
		if($this->arrowNext->hasLink())
		{
			$this->arrowNext->setSubStyle($this->arrowNextStyle);
		}
		if($this->arrowPrev->hasLink())
		{
			$this->arrowPrev->setSubStyle($this->arrowPrevStyle);
		}
		if($this->arrowNext->hasLink() && $this->arrowFastNext->hasLink())
		{
			$this->arrowFastNext->setSubStyle($this->arrowFastNextStyle);
		}
		else
		{
			$this->arrowFastNext->setManialink(null);
		}
		if($this->arrowPrev->hasLink() && $this->arrowFastPrev->hasLink())
		{
			$this->arrowFastPrev->setSubStyle($this->arrowFastPrevStyle);
		}
		else
		{
			$this->arrowFastPrev->setManialink(null);
		}
		if($this->arrowNext->hasLink() && $this->arrowLast->hasLink())
		{
			$this->arrowLast->setSubStyle($this->arrowLastStyle);
		}
		else
		{
			$this->arrowLast->setManialink(null);
		}
		if($this->arrowPrev->hasLink() && $this->arrowFirst->hasLink())
		{
			$this->arrowFirst->setSubStyle($this->arrowFirstStyle);
		}
		else
		{
			$this->arrowFirst->setManialink(null);
		}

		// Text
		$this->text->setStyle(\ManiaLib\Manialink\Elements\Label::TextValueSmall);
		$this->text->setText($this->currentPage.' / '.$this->pageNumber);

		// Positioning in relation to the center of the containing frame
		$this->text->setAlign("center", "center2");
		$this->text->setPosZ(1);

		$this->textBg->setSubStyle(\ManiaLib\Manialink\Elements\Bgs1::BgPager);
		$this->textBg->setAlign('center', 'center');
		$this->textBg->setPosZ(.5);

		$this->arrowNext->setValign("center");
		$this->arrowFastNext->setValign("center");
		$this->arrowLast->setValign("center");

		$this->arrowNext->setPosition(($this->text->getSizeX() / 2) + 1, 0, 1);
		$this->arrowFastNext->setPosition($this->arrowNext->getPosX() + $this->arrowNext->getSizeX(), 0, 1);
		$this->arrowLast->setPosition(
			$this->arrowNext->getPosX() +
			(int) $this->showFastNext * $this->arrowFastNext->getSizeX() +
			$this->arrowNext->getSizeX(), 0, 1);

		$this->arrowPrev->setAlign("right", "center");
		$this->arrowFastPrev->setAlign("right", "center");
		$this->arrowFirst->setAlign("right", "center");

		$this->arrowPrev->setPosition(-($this->text->getSizeX() / 2) - 1, 0, 1);
		$this->arrowFastPrev->setPosition($this->arrowPrev->getPosX() - $this->arrowPrev->getSizeX(), 0, 1);
		$this->arrowFirst->setPosition(
			$this->arrowPrev->getPosX() -
			(int) $this->showFastNext * $this->arrowFastPrev->getSizeX() -
			$this->arrowPrev->getSizeX(), 0, 1);

		// Save the gui
		if($this->showText)
		{
			$this->add($this->textBg);
			$this->add($this->text);
		}
		$this->add($this->arrowNext);
		$this->add($this->arrowPrev);
		if($this->showLast)
		{
			$this->add($this->arrowFirst);
			$this->add($this->arrowLast);
		}
		if($this->showFastNext)
		{
			$this->add($this->arrowFastNext);
			$this->add($this->arrowFastPrev);
		}
	}

}

?>