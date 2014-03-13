<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\Manialink\Layouts\AbstractLayout;
use ManiaLib\Manialink\Node;
use ManiaLib\Manialink\Utils;

abstract class Base extends Node
{

	protected $posnX;
	protected $posnY;
	protected $posnZ;
	protected $sizenX;
	protected $sizenY;

	function __construct()
	{
		$this->registerCallback('prefilter', array($this, 'preFilterLayout'));
		$this->registerCallback('prefilter', array($this, 'preFilterRelativePosition'));
		$this->registerCallback('prefilter', array($this, 'preFilterPosition'));
		$this->registerCallback('prefilter', array($this, 'preFilterSize'));
		$this->registerCallback('postfilter', array($this, 'postFilterLayout'));
	}

	protected function preFilterPosition()
	{
		if(!$this->attributeExists('posn'))
		{
			if($this->posnX !== null || $this->posnY !== null || $this->posnZ !== null)
			{

				$this->setAttribute('posn',
					(float) $this->posnX.' '.(float) $this->posnY.' '.(float) $this->posnZ);
			}
		}
	}

	protected function preFilterSize()
	{
		if(!$this->attributeExists('sizen'))
		{
			if($this->sizenX !== null || $this->sizenY !== null)
			{
				$this->setAttribute('sizen', (float) $this->sizenX.' '.(float) $this->sizenY);
			}
		}
	}

	protected function preFilterLayout()
	{
		if($this->getParent() instanceof Frame && $this->getParent()->getLayout() instanceof AbstractLayout)
		{
			$this->getParent()->getLayout()->preFilter($this);
			$this->getParent()->getLayout()->updateChild($this);
		}
	}

	protected function postFilterLayout()
	{
		if($this->getParent() instanceof Frame && $this->getParent()->getLayout() instanceof AbstractLayout)
		{
			$this->getParent()->getLayout()->postFilter($this);
		}
	}

	protected function preFilterRelativePosition()
	{
		if($this->getParent() instanceof Base)
		{
			if($this->getParent()->getSizenX() && $this->getRelativeHalign())
			{
				$xIncrement = Utils::getAlignedPosX(0, $this->getParent()->getSizenX(),
						$this->getParent()->getHalign(), $this->getRelativeHalign());
				$this->setPosnX($this->getPosnX() + $xIncrement);
				$this->deleteAttribute('relativehalign');
			}
			if($this->getParent()->getSizenY() && $this->getRelativeValign())
			{
				$yIncrement = Utils::getAlignedPosY(0, $this->getParent()->getSizenY(),
						$this->getParent()->getValign(), $this->getRelativeValign());
				$this->setPosnY($this->getPosnY() + $yIncrement);
				$this->deleteAttribute('relativevalign');
			}
		}
		// TODO Good idea?
		elseif($this->getParent() instanceof Manialink)
		{
			if($this->getRelativeHalign())
			{
				$xIncrement = Utils::getAlignedPosX(0, 320, 'center', $this->getRelativeHalign());
				$this->setPosnX($this->getPosnX() + $xIncrement);
				$this->deleteAttribute('relativehalign');
			}
			if($this->getRelativeValign())
			{
				$yIncrement = Utils::getAlignedPosY(0, 180, 'center', $this->getRelativeValign());
				$this->setPosnY($this->getPosnY() + $yIncrement);
				$this->deleteAttribute('relativevalign');
			}
		}
	}

	function getRealSizenX()
	{
		return $this->sizenX * $this->getAttribute("scale", 1);
	}

	function getRealSizenY()
	{
		return $this->sizenY * $this->getAttribute("scale", 1);
	}

	/**
	 * @return \static
	 */
	function setPosn($posnX = null, $posnY = null, $posnZ = null)
	{
		if($posnX !== null)
		{
			$this->setPosnX($posnX);
		}
		if($posnY !== null)
		{
			$this->setPosnY($posnY);
		}
		if($posnZ !== null)
		{
			$this->setPosnZ($posnZ);
		}
		return $this;
	}

	/**
	 * @return \static
	 */
	function setSizen($sizenX = null, $sizenY = null)
	{
		if($sizenX !== null)
		{
			$this->setSizenX($sizenX);
		}
		if($sizenY !== null)
		{
			$this->setSizenY($sizenY);
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
	function setSizenX($sizenX)
	{
		$this->sizenX = $sizenX;
		return $this;
	}

	/**
	 * @return \static
	 */
	function setSizenY($sizenY)
	{
		$this->sizenY = $sizenY;
		return $this;
	}

	function getSizenX()
	{
		return $this->sizenX;
	}

	function getSizenY()
	{
		return $this->sizenY;
	}

	/**
	 * @return \static
	 */
	function setAlign($halign = null, $valign = null)
	{
		if($halign !== null)
		{
			$this->setHalign($halign);
		}
		if($valign !== null)
		{
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
		if($halign !== null)
		{
			$this->setRelativeHalign($halign);
		}
		if($valign !== null)
		{
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
		if(count($explodedStyle) == 2)
		{
			list($_style, $_substyle) = $explodedStyle;
			return $this->setAttribute('style', $_style)->setAttribute('substyle', $_substyle);
		}
		else
		{
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
	function setStyle3d($style3d)
	{
		return $this->setAttribute("style3d", $style3d);
	}

	function getStyle3d()
	{
		return $this->getAttribute("style3d");
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
	function setManiazones($maniazones)
	{
		return $this->setAttribute("maniazones", $maniazones);
	}

	function getManiazones()
	{
		return $this->getAttribute("maniazones");
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
	function setScriptevents($scriptevents)
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
	function setModulizecolor($modulizecolor)
	{
		return $this->setAttribute("modulizecolor", $modulizecolor);
	}

	function getModulizecolor()
	{
		return $this->getAttribute("modulizecolor");
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

}
