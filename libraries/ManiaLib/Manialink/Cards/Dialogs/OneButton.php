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

namespace ManiaLib\Manialink\Cards\Dialogs;

use ManiaLib\Manialink\Elements\Label;

class OneButton extends \ManiaLib\Manialink\Cards\Panel
{

	/**
	 * @var \ManiaLib\Manialink\Elements\Button
	 */
	public $button;

	/**
	 * @var \ManiaLib\Manialink\Elements\Label
	 */
	public $text;

	function __construct($sizeX = 65, $sizeY = 25)
	{
		parent::__construct($sizeX, $sizeY);

		$this->setSubStyle(\ManiaLib\Manialink\Elements\Bgs1::BgWindow2);
		$this->title->setStyle(\ManiaLib\Manialink\Elements\Label::TextTitle2);
		$this->addCardElement($this->title);

		$this->button = new \ManiaLib\Manialink\Elements\Button;
		$this->button->setAlign('center', 'bottom');
		$this->addCardElement($this->button);

		$this->text = new Label();
		$this->text->setAlign('center', 'center');
		$this->text->enableAutonewline();
//		$this->text->setStyle(Label::TextStaticMedium);
		$this->addCardElement($this->text);
	}

	function preFilter()
	{
		parent::preFilter();
		$this->text->setSize($this->sizeX - 6, $this->sizeY - 11);
		$this->text->setPositionY(- $this->sizeY / 2 - 5);
		$this->button->setPositionY(5 - $this->sizeY);
	}

}

?>