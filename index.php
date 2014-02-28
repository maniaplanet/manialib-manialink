<?php

use ManiaLib\Manialink\Elements\Manialink;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\Manialink\Elements\Redirect;
use ManiaLib\Manialink\Elements\Timeout;
use ManiaLib\Manialink\Renderer;
use ManiaLib\Manialink\Styles\Bgs1;

require_once __DIR__.'/libraries/autoload.php';

header('Content-Type: text/xml; charset=utf-8');

$manialink = new Manialink();
$manialink->appendChild(Redirect::create()->setNodeValue('hahaha'));
$manialink->appendChild(Timeout::create());
$manialink->appendChild(Quad::create()->setAttribute('sizen', '20 20')->setAttribute('posnX', '3.12')->setStyle(Bgs1::BgWindow1));

$renderer = new Renderer();
$renderer->setRoot($manialink);
echo $renderer->getXML();


