ManiaLib\Manialink
===================================================

[![Latest Stable Version](https://poser.pugx.org/maniaplanet/manialib-manialink/v/unstable.png)](https://packagist.org/packages/maniaplanet/manialib-manialink)
[![Total Downloads](https://poser.pugx.org/maniaplanet/manialib-manialink/downloads.png)](https://packagist.org/packages/maniaplanet/manialib-manialink)
[![License](https://poser.pugx.org/maniaplanet/manialib-manialink/license.png)](https://packagist.org/packages/maniaplanet/manialib-manialink)

ManiaLib\Manialink is an object-oriented PHP framework for writing Manialink interfaces.

Compared to former version of ManiaLib, this is just meant to be a standalone package to build Manialink pages.
It can be used in any sort of projects, from Web frameworks (eg. ManiaLib) to server controllers (eg. ManiaLive).

It shares some common code with ManiaLib\Gui, but a lot was changed in naming and overall architecture.

Work in progress
-----------------------------

Please beware this is a wip lib. We might break stuff at any time. But it is also the time to ask for features to be considered!

Installation
-----------------------------

[Co-co-co-Composer \o/](https://getcomposer.org/):

```
{
	"require": {
        "maniaplanet/manialib-manialink": "dev-master"
    }
}
```

Architecture
-----------------------------

 * Every element is a child of `ManiaLib\Manialink\Node`.
 * No constructor arguments.
 * Setter methods return the element.
 * `ManiaLib\Manialink\Node::create()` instanciates the object and returns it for easy chaining. 
If you're running PHP 5.4+ you can use class member access on instantiation instead eg. 
`(new Node)->setAttribute('foo', 'bar')`.
 * The important methods of Node are:

```
namespace ManiaLib\Manialink;

abstract class Node
{
	function setAttribute($name, $value)
	function setNodeValue($value)
	function appendChild(Node $child)
	function appendTo(Node $parent)
}
```

 * Most element should implement setter for usual attributes (eg. `ManiaLib\Manialink\Elements\Quad::setImage($image)`), 
but if the setter doesnt exists you can use `setAttribute($name, $value)` instead.
 * For style and substyle, the setStyle($style) method handles both at once when used with abstract classes 
in `ManiaLib\Manialink\Styles\` eg. `Quad::create()->setStyle(Bgs1::BgWindow1);`
 * Actual XML rendering is done by an implementation of `ManiaLib\Manialink\Rendering\RendererInterface` (see examples for usage).

Examples
-----------------------------

```
<?php

use ManiaLib\Manialink\Cards\LabelBox;
use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Label;
use ManiaLib\Manialink\Elements\Manialink;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\Manialink\Elements\Script;
use ManiaLib\Manialink\Elements\Timeout;
use ManiaLib\Manialink\Elements\XMLFragment;
use ManiaLib\Manialink\Layouts\Line;
use ManiaLib\Manialink\Rendering\Renderer;
use ManiaLib\Manialink\Styles\Bgs1;

error_reporting(E_ALL);

require_once __DIR__.'/vendor/autoload.php';

$ml = new Manialink();

Timeout::create()
	->setNodeValue(0)
	->appendTo($ml);

$frame = Frame::create()
	->setPosn(-150, 80)
	->appendTo($ml);

Quad::create()
	->setSizen(50, 10)
	->setPosn(2, 0, 0.1)
	->setStyle(Bgs1::BgWindow1)
	->appendTo($frame);

Label::create()
	->setSizen(50, 5)
	->setPosn(0, -15, 0.1)
	->setText('hello world')
	->appendTo($frame);

$frame2 = Frame::create()
	->setPosn(0, -25, 0.1)
	->setLayout(Line::create()->setMarginWidth(1))
	->appendTo($frame);

for($i = 0; $i < 5; $i++)
{
	Quad::create()
		->setSizen(5, 5)
		->setBgcolor('ccc')
		->appendTo($frame2);
}

$ui = LabelBox::create()
	->setPosn(0, -35)
	->setSizen(100, 10)
	->appendTo($frame);
$ui->getBg()
	->setStyle(Bgs1::BgTitle3);
$ui->getLabel()
	->setText('Much foobar')
	->setTextSize(4);

$frame2 = Frame::create()
	->setPosn(0, -50)
	->setSizen(50, 50)
	->setAlign('left', 'top')
	->appendTo($frame);

Quad::create()
	->setSizen(50, 50)
	->setBgcolor('eee')
	->appendTo($frame2);

Quad::create()
	->setSizen(10, 10)
	->setPosnZ(0.1)
	->setAlign('right', 'bottom')
	->setRelativeAlign('right', 'bottom')
	->setBgcolor('ccc')
	->appendTo($frame2);

Script::create()
	->setNodeValue('main(){ log("Hello world"); } // < &')
	->appendTo($ml);

XMLFragment::create()
	->setNodeValue('<label text="This label is written directly in XML" />')
	->appendTo($ml);

header('Content-type: application/xml; charset=utf-8');

$renderer = new Renderer();
$renderer->setRoot($ml);
echo $renderer->getXML();

```

This will output:

```
<?xml version="1.0" encoding="UTF-8"?>
<manialink version="1">
	<timeout>0</timeout>
	<frame posn="-150 80 0">
		<quad style="Bgs1" substyle="BgWindow1" posn="2 0 0.1" sizen="50 10"/>
		<label text="hello world" posn="0 -15 0.1" sizen="50 5"/>
		<frame posn="0 -25 0.1">
			<quad bgcolor="ccc" posn="0 0 0" sizen="5 5"/>
			<quad bgcolor="ccc" posn="6 0 0" sizen="5 5"/>
			<quad bgcolor="ccc" posn="12 0 0" sizen="5 5"/>
			<quad bgcolor="ccc" posn="18 0 0" sizen="5 5"/>
			<quad bgcolor="ccc" posn="24 0 0" sizen="5 5"/>
		</frame>
		<frame posn="0 -35 0">
			<quad style="Bgs1" substyle="BgTitle3" sizen="100 10"/>
			<label halign="center" valign="center" text="Much foobar" textsize="4" posn="50 -5 0.1"/>
		</frame>
		<frame posn="0 -50 0">
			<quad bgcolor="eee" sizen="50 50"/>
			<quad halign="right" valign="bottom" bgcolor="ccc" posn="50 -50 0.1" sizen="10 10"/>
		</frame>
	</frame>
	<script>main(){ log("Hello world"); } // &lt; &amp;</script>
	<label text="This label is written directly in XML"/>
</manialink>

```

Todo
-----------------------------
 * XMLComment
 * setNodeValue? setValue?
 * Bug layouts dans Frame3d?
 * Driver examples
 * Implement all Element classes
 * Implement all layouts
 * Relative position bug (?)
 * Doc
 
