<?php

namespace ManiaLib\Manialink\Elements;

class Entry extends Base
{
	protected $tagName = 'entry';
	
	/**
	 * @param string $default
	 * @return static
	 */
	public function setDefault($default)
	{
		return $this->setAttribute('default', $default);
	}
	
	public function getDefault()
	{
		return $this->getAttribute('default');
	}
	
	/**
	 * @param int $autonewline
	 * @return static
	 */
	public function setAutonewline($autonewline = 1)
	{
		return $this->setAttribute($autonewline);
	}
	
	public function getAutonewline()
	{
		return $this->getAttribute('autonewline');
	}
}