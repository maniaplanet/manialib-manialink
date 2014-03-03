<?php

use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Label;
use ManiaLib\Manialink\Elements\Manialink;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\Manialink\Elements\Redirect;
use ManiaLib\Manialink\Elements\Script;
use ManiaLib\Manialink\Elements\Timeout;
use ManiaLib\Manialink\Layouts\Line;
use ManiaLib\Manialink\Renderer;
use ManiaLib\Manialink\Styles\Bgs1;

error_reporting(E_ALL);

require_once __DIR__.'/src/autoload.php';

header('Content-Type: text/xml; charset=utf-8');

$manialink = new Manialink();
$manialink->appendChild(Redirect::create()->setNodeValue('hahaha'));
$manialink->appendChild(Timeout::create());

$frame = Frame::create()->setPosn(10, 5, 1);
$frame->appendChild(Quad::create()->setSizen(20, 20)->setPosn(10, 2, 23.3)->setStyle(Bgs1::BgWindow1));
$frame->appendChild(Label::create()->setSizen(50, 5)->setPosn(10, -5, 23)->setText('hello world'));
$manialink->appendChild($frame);

$manialink->appendChild(Script::create()->setNodeValue('< yes " " >'));

$frame = Frame::create()->setLayout(new Line());
$frame->appendChild(Quad::create()->setSizen(20, 20));
$frame->appendChild(Quad::create()->setSizen(20, 20));
$frame->appendChild(Quad::create()->setSizen(20, 20));
$frame->appendChild(Quad::create()->setSizen(20, 20));
$manialink->appendChild($frame);

$renderer = new Renderer();
$renderer->setRoot($manialink);
echo $renderer->getXML();


