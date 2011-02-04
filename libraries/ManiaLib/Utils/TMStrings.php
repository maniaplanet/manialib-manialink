<?php 
/**
 * ManiaLib - Lightweight PHP framework for Manialinks
 * 
 * @copyright   Copyright (c) 2009-2011 NADEO (http://www.nadeo.com)
 * @license     http://www.gnu.org/licenses/lgpl.html LGPL License 3
 * @version     $Revision$:
 * @author      $Author$:
 * @date        $Date$:
 */

namespace ManiaLib\Utils;

/** 
 * Misc methods for TM styled string and other common formatting tasks
 */ 
abstract class TMStrings
{
	/**
	 * Allows to safely put any TM-formatted string into another TM-formatted string
	 * without conflicts (conflict example: you put a nickname in the middle of the
	 * sentance, the nickname has some bold characters and all the end of the
	 * sentance becomes bold)
	 * @param string Unprotected string
	 * @param string Protected string
	 */
	static function protectStyles($string)
	{
		return '$<'.$string.'$>';
	}
	
	/**
	 * Removes some TM styles (wide, bold and shadowed) to avoid wide words
	 * @param string
	 * @return string
	 */
	static function stripWideFonts($string)
	{
		return str_replace(array (
			'$w',
			'$o',
			'$s'
		), "", $string);
	}
	
	/**
	 * Removes TM links
	 * @param string
	 * @return string
	 */
	static function stripLinks($string)
	{
		return preg_replace(
			'/\\$[hlp](.*?)(?:\\[.*?\\](.*?))?(?:\\$[hlp]|$)/ixu', '$1$2', 
			$string);
	}
	
	/**
	 * Format a line with [yellow bold] title + content label
	 * eg: "<b>Title:</b>   content"
	 */
	static function formatLine($title, $label='', $titleStyle = '$o$ff0', $labelStyle = '')
	{
		return '$<'.$titleStyle.$title.'$<$n $>:$>'.'    '.$labelStyle.$label;
	}
	
	/**
	 * 350 Coppers or N/A 
	 */
	static function formatCoppersAmount($amount, $strict = true)
	{
		if(!$amount && $strict)
		{
			return _('N/A');
		}
		else
		{
			return sprintf(_('%s Coppers'), $amount);
		}
	}
	
	static function formatDate($timestamp)
	{
		return date('l jS \of F Y', $timestamp);
	}
	
	static function formatLongDate($timestamp)
	{
		//return date('l jS \of F Y @ h:i A e', $timestamp);
		return date('r', $timestamp);
	}
}


?>