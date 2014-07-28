ManiaLib\Manialink
===================================================

[![Latest Stable Version](https://poser.pugx.org/maniaplanet/manialib-manialink/v/stable.png)](https://packagist.org/packages/maniaplanet/manialib-manialink)
[![Latest Unstable Version](https://poser.pugx.org/maniaplanet/manialib-manialink/v/unstable.svg)](https://packagist.org/packages/maniaplanet/manialib-manialink)
[![Total Downloads](https://poser.pugx.org/maniaplanet/manialib-manialink/downloads.png)](https://packagist.org/packages/maniaplanet/manialib-manialink)
[![Build](https://travis-ci.org/maniaplanet/manialib-manialink.svg)](https://travis-ci.org/#!/maniaplanet/manialib-manialink)

ManiaLib\Manialink is an object-oriented PHP library for writing Manialink interfaces based on [ManiaLib\XML](https://github.com/maniaplanet/manialib-xml).

We discuss about it at http://forum.maniaplanet.com/viewtopic.php?f=40&t=25999

Installation
-----------------------------

[Install via Composer](https://getcomposer.org/):

```JSON
{
	"require": {
        "maniaplanet/manialib-manialink": "0.3.*@dev"
    }
}
```

Features
-----------------------------
 * Features of [ManiaLib\XML](https://github.com/maniaplanet/manialib-xml)
 * Frame logical size and alignment
 * Relative Alignment of child inside sized parent
 * Cards for composing complex reusable sets of elements
 * Helper classes for all styles/substyles

Architecture
-----------------------------

 * See [ManiaLib\XML](https://github.com/maniaplanet/manialib-xml)
 * Most element should implement setter for usual attributes (eg. `ManiaLib\Manialink\Elements\Quad::setImage($image)`), 
but if the setter doesnt exists you can use `setAttribute($name, $value)` instead.
 * For style and substyle, the setStyle($style) method handles both at once when used with abstract classes 
in `ManiaLib\Manialink\Styles\` eg. `Quad::create()->setStyle(Bgs1::BgWindow1);`

Examples
-----------------------------

See /examples directory


Alignment and Relative Alignment 
-----------------------------

 * Frame Size and Alignment emulates the behaviour of standard elements alignment in frames. With this you can create logical containers with a size, and position them using aligns and relative aligns (see below).
 * Relative Alignment helps position an element relative to its parent container. For this, you need a frame with a size and a child with a size ; for instance you can put a quad in the "bottom right corner of a frame with a size".

To help understand these concepts visually:
 * Cheat sheet manialink: http://maniapla.net/#url=manialib-manialink:align
 * Source: see in /example/alignments-cheat-sheet.php


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
 
