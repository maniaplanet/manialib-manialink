<?php
require_once __DIR__.'/libraries/autoload.php';

header('Content-Type: text/plain');

function printSetter($name)
{
	echo
	"\t".'function set'.ucfirst($name).'($'.$name.')'."\n".
	"\t".'{'."\n".
	"\t\t".'return $this->setAttribute("'.$name.'", '.'$'.$name.');'."\n".
	"\t".'}'."\n".
	"\n";
}

function printGetter($name)
{
	echo
	"\t".'function get'.ucfirst($name).'()'."\n".
	"\t".'{'."\n".
	"\t\t".'return $this->getAttribute("'.$name.'");'."\n".
	"\t".'}'."\n".
	"\n";
}

function dothebarrelroll()
{
	foreach(func_get_args() as $name)
	{
		printSetter($name);
		printGetter($name);
	}
	hr();
}

function hr()
{
	echo '--------------------------------------------------------------------------------'."\n\n";
}

dothebarrelroll('id', 'class', 'hidden');
dothebarrelroll('posn', 'scale');
dothebarrelroll('sizen', 'halign', 'valign');
dothebarrelroll('style', 'substyle', 'style3d');
dothebarrelroll('manialink', 'maniazones', 'goto', 'url', 'action', 'scriptevents');