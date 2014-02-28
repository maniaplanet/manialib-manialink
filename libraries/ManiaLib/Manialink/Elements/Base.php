<?php

namespace ManiaLib\Manialink\Elements;

abstract class Base extends \ManiaLib\Manialink\Node
{

	function __construct()
	{
		$this->registerCallback('prefilter', array($this, 'preFilterPosition'));
		$this->registerCallback('prefilter', array($this, 'preFilterSize'));
	}

	protected function preFilterPosition()
	{
		if(!$this->attributeExists('posn'))
		{
			$posnX = $this->getAttribute('posnX', 0);
			$posnY = $this->getAttribute('posnY', 0);
			$posnZ = $this->getAttribute('posnZ', 0);
			$this->deleteAttribute('posnX')->deleteAttribute('posnY')->deleteAttribute('posnZ');
			$this->setAttribute('posn', $posnX.' '.$posnY.' '.$posnZ);
		}
	}

	protected function preFilterSize()
	{
		if(!$this->attributeExists('sizen') && ($this->attributeExists('sizenX') || $this->attributeExists('sizenY')))
		{
			$sizenX = $this->getAttribute('sizenX', 0);
			$sizenY = $this->getAttribute('sizenY', 0);
			$this->deleteAttribute('sizenX')->deleteAttribute('sizenY');
			$this->setAttribute('sizen', $sizenX.' '.$sizenY);
		}
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
			$this->setPosnY($posnY);
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
	function setStyle($style)
	{
		$style = explode(':', $style);
		if(count($style) == 2)
		{
			list($_style, $_substyle) = $style;
			return $this->setAttribute('style', $_style)->setAttribute('substyle', $_substyle);
		}
		else
		{
			return $this->setAttribute('style', $_style);
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
	function setPosnX($posnX)
	{
		return $this->setAttribute("posnX", $posnX);
	}

	function getPosnX()
	{
		return $this->getAttribute("posnX");
	}

	/**
	 * @return \static
	 */
	function setPosnY($posnY)
	{
		return $this->setAttribute("posnY", $posnY);
	}

	function getPosnY()
	{
		return $this->getAttribute("posnY");
	}

	/**
	 * @return \static
	 */
	function setPosnZ($posnZ)
	{
		return $this->setAttribute("posnZ", $posnZ);
	}

	function getPosnZ()
	{
		return $this->getAttribute("posnZ");
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
	function setSizenX($sizenX)
	{
		return $this->setAttribute("sizenX", $sizenX);
	}

	function getSizenX()
	{
		return $this->getAttribute("sizenX");
	}

	/**
	 * @return \static
	 */
	function setSizenY($sizenY)
	{
		return $this->setAttribute("sizenY", $sizenY);
	}

	function getSizenY()
	{
		return $this->getAttribute("sizenY");
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
