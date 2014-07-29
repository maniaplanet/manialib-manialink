<?php
require_once __DIR__.'/../vendor/autoload.php';

use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Label;
use ManiaLib\Manialink\Elements\Manialink;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\Manialink\Elements\Timeout;
use ManiaLib\Manialink\Layouts\Line;
use ManiaLib\Manialink\Styles\Icons64x64_1;
use ManiaLib\Manialink\Styles\LabelStyles;

error_reporting(E_ALL);

$ml = new Manialink();

Timeout::create()
    ->setNodeValue(0)
    ->appendTo($ml);

$alignements = array('left', 'center', 'right');

Label::create()
    ->setText('Line layout examples')
    ->setAlign('center')
    ->setStyle(LabelStyles::TextRaceMessageBig)
    ->setPosn(0, 80)
    ->appendTo($ml);

$contentFrame = Frame::create()
    ->setPosn(-150, 60)
    ->setLayout(Line::create())
    ->appendTo($ml);

foreach($alignements as $key => $aligmenement)
{
    $testFrame = Frame::create()
        ->setSizen(90, 35)
        ->appendTo($contentFrame);

    Label::create()
        ->setBothAlign('center')
        ->setText(sprintf('%s align', ucfirst($aligmenement)))
        ->setStyle(LabelStyles::TextTitle3)
        ->setPosn(0, -3)
        ->appendTo($testFrame);

    Quad::create()
        ->setSizen(6, 6)
        ->setRelativeValign('center')
        ->setAlign('center', 'center')
        ->setPosn(25, -3, 2)
        ->setStyle(Icons64x64_1::QuitRace)
        ->appendTo($testFrame);

    $frame = Frame::create()
        ->setRelativeValign('center')
        ->setPosn(25, -3)
        ->setLayout(Line::create()->setMarginWidth(1))
        ->appendTo($testFrame);

    for($i = 0; $i < 3; $i++)
    {
        Quad::create()
            ->setSizen(20, 20)
            ->setAlign($aligmenement, 'center')
            ->setBgcolor('F00')
            ->setOpacity(0.5)
            ->appendTo($frame);
    }
}



$testFrame = Frame::create()
    ->setPosn(-45, 20)
    ->setSizen(90, 35)
    ->appendTo($ml);

Label::create()
    ->setBothAlign('center')
    ->setText('left and right align')
    ->setStyle(LabelStyles::TextTitle3)
    ->setPosn(0, -3)
    ->appendTo($testFrame);

Quad::create()
    ->setSizen(6, 6)
    ->setRelativeValign('center')
    ->setAlign('center', 'center')
    ->setPosn(25, -3, 2)
    ->setStyle(Icons64x64_1::QuitRace)
    ->appendTo($testFrame);

$frame = Frame::create()
    ->setRelativeValign('center')
    ->setPosn(25, -3)
    ->setLayout(Line::create()->setMarginWidth(1))
    ->appendTo($testFrame);

for($i = 0; $i < 3; $i++)
{
    Quad::create()
        ->setSizen(20, 20)
        ->setHalign($i % 2 == 0 ? 'left' : 'right')
        ->setBgcolor('F00')
        ->setOpacity(0.5)
        ->appendTo($frame);
}

return $ml;
