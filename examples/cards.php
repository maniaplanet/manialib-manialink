<?php

use ManiaLib\Manialink\Cards\Box;
use ManiaLib\Manialink\Cards\LabelBox;
use ManiaLib\Manialink\Elements\Manialink;
use ManiaLib\Manialink\Elements\Timeout;
use ManiaLib\Manialink\Renderer;
use ManiaLib\Manialink\Styles\Bgs1;

error_reporting(E_ALL);
require_once __DIR__.'/../src/autoload.php';
header('Content-Type: text/xml; charset=utf-8');

$manialink = Manialink::create();
$manialink->appendChild(Timeout::create());

$ui = Box::create()->setSizen(10, 10)->setScale(2)->setBothAlign('center', 'center');
$ui->bg->setBgcolor('ccc');
$manialink->appendChild($ui);

$ui = LabelBox::create()->setSizen(100, 15)->setPosn(0, -20)->setAlign('center', 'center');
$ui->bg->setStyle(Bgs1::BgWindow1);
$ui->label->setText('Hello world');
//$manialink->appendChild($ui);

$renderer = new Renderer();
$renderer->setRoot($manialink);
echo $renderer->getXML();
