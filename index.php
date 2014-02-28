<?php

use ManiaLib\Manialink\Elements\Manialink;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\Manialink\Elements\Timeout;
use ManiaLib\Manialink\Renderer;

require_once __DIR__.'/libraries/autoload.php';

header('Content-Type: text/xml; charset=utf-8');

$manialink = new Manialink();
$manialink->appendChild(Timeout::create());
$manialink->appendChild(Quad::create()->setAttribute('sizen', '20 20')->setAttribute('posnX', '3.12'));


$renderer = new Renderer();
$renderer->setRoot($manialink);
echo $renderer->getXML();


