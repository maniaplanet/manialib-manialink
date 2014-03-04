ManiaLib\Manialink
===================================================

*Work in progress*

ManiaLib\Manialink is an object-oriented PHP framework for writing Manialink interfaces.

Compared to former version of ManiaLib, this is just meant to be a standalone package to build Manialink pages.
It can be used in any sort of projects, from Web frameworks (eg. ManiaLib) to server controllers (eg. ManiaLive).

It shares some common code with ManiaLib\Gui, but a lot was changed in naming an overall architecture.

Installation
-----------------------------

Easy install with [Composer](https://getcomposer.org/):

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
 * No element has constructor arguments.
 * Every setter method returns the element.
 * `ManiaLib\Manialink\Node::create()` instanciate the element and returns it for easy chaining of setters. If you're running PHP5.4+ you can use class member access on instantiation instead eg. `(new Node)->setAttribute('foo', 'bar')`.
 * The important method of Node are:

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

 * Most element should implement setter for usual attributes (eg. `ManiaLib\Manialink\Elements\Quad::setImage($image)`), but if the setter doesnt exists you can use `setAttribute($name, $value)` instead.
 * For style and substyle, the setStyle($style) method handles both at once when used with abstract classes in `ManiaLib\Manialink\Styles\` eg.
```
ManiaLib\Manialink\Elements\Quad::create()->setStyle(ManiaLib\Manialink\Styles\Bgs1::BgWindow1);
```
 * Actual XML rendering is done by an implementation of `ManiaLib\Manialink\Rendering\RendererInterface` (see examples for usage).

Examples
-----------------------------

\o/

Todo
-----------------------------
 * Implement all Element classes
 * Implement all Styles classes
 * Implement all layouts
 * Relative position bug (?)
 * Doc