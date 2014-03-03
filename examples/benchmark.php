<?php

use ManiaLib\Manialink\Cards\Box;
use ManiaLib\Manialink\Cards\LabelBox;
use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Label;
use ManiaLib\Manialink\Elements\Manialink;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\Manialink\Elements\Script;
use ManiaLib\Manialink\Elements\Timeout;
use ManiaLib\Manialink\Layouts\Line;
use ManiaLib\Manialink\Rendering\DOMDocumentRenderer;
use ManiaLib\Manialink\Rendering\RendererInterface;
use ManiaLib\Manialink\Rendering\SimpleXMLRenderer;
use ManiaLib\Manialink\Rendering\XMLWriterRenderer;
use ManiaLib\Manialink\Styles\Bgs1;

error_reporting(E_ALL);
require_once __DIR__.'/../src/autoload.php';
header('Content-Type: text/plain; charset=utf-8');
set_time_limit(0);

	const RUNS = 1000;

function benchmark($function, $name)
{
	echo "Test for $name\n";
	$time = microtime(true);
	for($i = 0; $i < RUNS; $i++)
	{
		call_user_func($function);
		echo ".";
	}
	echo "\n";
	$time = microtime(true) - $time;
	echo RUNS." runs in {$time}s\n--------------------------\n";
}

function makeTree()
{
	$manialink = Manialink::create();
	$manialink->appendChild(Timeout::create());

	$frame = Frame::create()->setSizen(100, 100)->setAlign('left', 'top');
	$frame->appendChild(Quad::create()->setSizen(10, 10)->setAlign('right', 'bottom')->setRelativeAlign('right', 'bottom')->setBgcolor('ccc'));
	$manialink->appendChild($frame);

	$frame = Frame::create()->setLayout(new Line());
	$frame->appendChild(Quad::create()->setSizen(20, 20));
	$frame->appendChild(Quad::create()->setSizen(20, 20));
	$manialink->appendChild($frame);

	$ui = Box::create()->setSizen(10, 10)->setScale(2)->setPosn(-150, 80);
	$ui->bg->setBgcolor('ccc');
	$manialink->appendChild($ui);

	$ui = LabelBox::create()->setSizen(100, 15)->setPosn(-150, 50);
	$ui->bg->setStyle(Bgs1::BgWindow1);
	$ui->label->setText('Hello world');
	$manialink->appendChild($ui);

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

	return $manialink;
}

function render(RendererInterface $renderer)
{
	$manialink = makeTree();
	$renderer->setRoot($manialink);
	$renderer->getXML();
	unset($manialink);
}

function renderDom()
{
	render(new DOMDocumentRenderer());
}

function renderSimple()
{
	render(new SimpleXMLRenderer());
}

function renderWriter()
{
	render(new XMLWriterRenderer());
}

benchmark('renderDom', 'DOM Document');
benchmark('renderSimple', 'Simple XML');
benchmark('renderWriter', 'XMLWriter');
