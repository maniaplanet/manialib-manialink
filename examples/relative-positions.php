<?php

use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Manialink;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\Manialink\Elements\Timeout;
use ManiaLib\Manialink\Renderer;

error_reporting(E_ALL);
require_once __DIR__.'/../src/autoload.php';
header('Content-Type: text/xml; charset=utf-8');

$manialink = Manialink::create();
$manialink->appendChild(Timeout::create());
$frame = Frame::create()->setSizen(100, 100)->setAlign('left', 'top');
$frame->appendChild(Quad::create()->setSizen(10, 10)->setAlign('right', 'bottom')->setRelativeAlign('right', 'bottom')->setBgcolor('ccc'));
$manialink->appendChild($frame);

$renderer = new Renderer();
$renderer->setRoot($manialink);
echo $renderer->getXML();


