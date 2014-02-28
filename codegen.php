<?php
require_once __DIR__.'/libraries/autoload.php';

header('Content-Type: text/plain');

function printSetter($name)
{
	echo
	"\t".'/**'."\n".
	"\t".' * @return \static'."\n".
	"\t".' */'."\n".
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
}

function hr()
{
	echo '--------------------------------------------------------------------------------'."\n\n";
}

dothebarrelroll('id', 'class', 'hidden');
dothebarrelroll('posnX', 'posnY', 'posnZ', 'scale');
dothebarrelroll('sizenX', 'sizenY','halign', 'valign');
dothebarrelroll('style', 'substyle', 'style3d');
dothebarrelroll('manialink', 'maniazones', 'goto', 'url', 'action', 'scriptevents');
dothebarrelroll('colorize', 'modulizecolor', 'opacity');
hr();
dothebarrelroll('image', 'imagefocus', 'bgcolor');
hr();
dothebarrelroll('textprefix', 'textemboss', 'textcolor', 'textsize', 'focusareacolor1', 'focusareacolor2');
hr();
dothebarrelroll('text', 'autonewline', 'maxline');