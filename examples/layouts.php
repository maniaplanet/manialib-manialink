<?php

use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Manialink;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\Manialink\Layouts\Line;
use ManiaLib\Manialink\Renderer;

error_reporting(E_ALL);
require_once __DIR__.'/../src/autoload.php';
header('Content-Type: text/xml; charset=utf-8');

$manialink = new Manialink();


$renderer = new Renderer();
$renderer->setRoot($manialink);
echo $renderer->getXML();


