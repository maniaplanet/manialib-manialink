ManiaLib\Manialink
===================================================

[![Total Downloads](https://poser.pugx.org/maniaplanet/manialib-manialink/downloads.png)](https://packagist.org/packages/maniaplanet/manialib-manialink)

ManiaLib\Manialink is an object-oriented PHP library for writing Manialink interfaces based on [ManiaLib\XML](https://github.com/maniaplanet/manialib-xml).

We discuss about it at http://forum.maniaplanet.com/viewtopic.php?f=40&t=25999

Installation
-----------------------------

[Install via Composer](https://getcomposer.org/):

```
{
	"require": {
        "maniaplanet/manialib-manialink": "~0.1"
    }
}
```

Features
-----------------------------
 * Features of [ManiaLib\XML](https://github.com/maniaplanet/manialib-xml#features)
 * Frame logical size and alignment
 * Relative Alignment of child inside sized parent
 * Cards for composing complex reusable sets of elements
 * Helper classes for all styles/substyles

Architecture
-----------------------------

 * Architecure of [ManiaLib\XML](https://github.com/maniaplanet/manialib-xml#architecture)
 * ManiaLib\Manialink\Elements are children of ManiaLib\XML\Node
 * Most element should implement setter for usual attributes (eg. `ManiaLib\Manialink\Elements\Quad::setImage($image)`), 
but if the setter doesnt exists you can use `setAttribute($name, $value)` instead.
 * For style and substyle, the setStyle($style) method handles both at once when used with abstract classes 
in `ManiaLib\Manialink\Styles\` eg. `Quad::create()->setStyle(Bgs1::BgWindow1);`
 * Actual XML rendering is done by an implementation of `ManiaLib\XML\Rendering\RendererInterface` (see examples for usage).

Example
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
use ManiaLib\XML\Fragment;
use ManiaLib\Manialink\Layouts\Line;
use ManiaLib\XML\Rendering\Renderer;
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

Fragment::create()
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

Alignment and Relative Alignment 
-----------------------------

 * Frame Size and Alignment emulates the behaviour of standard elements alignment in frames. With this you can create logical containers with a size, and position them using aligns and relative aligns (see below).
 * Relative Alignment helps position an element relative to its parent container. For this, you need a frame with a size and a child with a size ; for instance you can put a quad in the "bottom right corner of a frame with a size".

To help understand these concepts visually:
 * Cheat sheet manialink: http://maniapla.net/#url=manialib-manialink:align
 * Source: https://gist.github.com/gou1/9970824


Has it anything to do with ManiaLib Framework?
-----------------------------

Compared to former version of ManiaLib, this is just meant to be a standalone package to build Manialink pages.
It can be used in any sort of projects, from Web frameworks (eg. ManiaLib) to server controllers (eg. ManiaLive).
It shares some common code with ManiaLib\Gui, but a lot was changed in naming and overall architecture.

Todo
-----------------------------

 * Bug layouts dans Frame3d?
 * Implement all Element classes
 * Implement all layouts
 * PhpDoc
 
