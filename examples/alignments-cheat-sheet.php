<?php

// This code is used to generate the manialink page: http://maniapla.net/#url=manialib-manialink:align

use ManiaLib\Manialink\Elements\Frame;
use ManiaLib\Manialink\Elements\Label;
use ManiaLib\Manialink\Elements\Manialink;
use ManiaLib\Manialink\Elements\Quad;
use ManiaLib\Manialink\Elements\Timeout;
use ManiaLib\Manialink\Layouts\Flow;
use ManiaLib\Manialink\Styles\Icons64x64_1;
use ManiaLib\Manialink\Styles\LabelStyles;
use ManiaLib\XML\Rendering\Renderer;

error_reporting(E_ALL);

$manialink = Manialink::create()
    ->setVersion(1)
    ->setBackground('stations')
    ->setNavigable3d(0);

Timeout::create()
    ->setNodeValue(0)
    ->appendTo($manialink);

define('CELL_COUNT_X', 4);
define('CELL_COUNT_Y', 3);

$frame = Frame::create()
    ->setSizen(300, 160)
    ->setPosn(-150, 80, 0)
    ->setLayout(new Flow())
    ->appendTo($manialink);

$cases = array();

for ($y = 0; $y < CELL_COUNT_Y; $y++) {
    for ($x = 0; $x < CELL_COUNT_X; $x++) {
        $cases[] = Frame::create()
            ->setSizen(300 / CELL_COUNT_X, 160 / CELL_COUNT_Y)
            ->appendTo($frame)
            ->appendChild(
            Quad::create()
            ->setSizen(300 / CELL_COUNT_X, 160 / CELL_COUNT_Y)
            ->setBgcolor(($x + $y) % 2 ? 'ccc' : '666'));
    }
}

$title = Label::create()
    ->setSizen(300 / CELL_COUNT_X - 4, 10)
    ->setPosn(0, -1, 1)
    ->setBothAlign('center', 'top')
    ->setAutonewline(1)
    ->setStyle(LabelStyles::TextValueSmallSm)
    ->setTextSize(2)
    ->setTextcolor('ff0')
    ->appendTo($cases[0]);

$quad = Quad::create()
    ->setSizen(11, 11)
    ->setBgcolor('f00');

$frame = Frame::create()
    ->setPosn(15, -15, 1)
    ->appendChild(
    Quad::create()
    ->setSizen(10, 10)
    ->setPosn(0, 0, 5)
    ->setAlign('center', 'center')
    ->setStyle(Icons64x64_1::QuitRace)
);

$frameSize = $frame->getClone()->setSizen(30, 30)->appendChild(Quad::create()->setSizen(30, 30)->setBgcolor('fff5'));

$frameSizeAlign = $frameSize->getClone()->setAlign('center', 'center')->setPosn(30, -30);
$elt            = $frameSizeAlign->getChildren();
$elt            = reset($elt);
$elt->setRelativeAlign('center', 'center');

$frameSizeSmall = $frame->getClone()->setPosn(0, 0, 1)->setSizen(13, 13)->appendChild(Quad::create()->setSizen(13, 13)->setBgcolor('fff5'));

$quadSmall = $quad->getClone()->setSizen(7, 7);


$cases[0]->appendChild($title->getClone()->setText('1. Frame + Quad'));
$cases[0]->appendChild($frame->getClone()->appendChild($quad->getClone()));

$cases[1]->appendChild($title->getClone()->setText('2. Frame + Quad + Align'));
$cases[1]->appendChild($frame->getClone()->appendChild($quad->getClone()->setAlign('center', 'center')));

$cases[2]->appendChild($title->getClone()->setText('3. Frame + Size + Quad'));
$cases[2]->appendChild($frameSize->getClone()->appendChild($quad->getClone()));

$cases[3]->appendChild($title->getClone()->setText('4. Frame + Size + Quad + Align'));
$cases[3]->appendChild($frameSize->getClone()->appendChild($quad->getClone()->setAlign('center', 'center')));

$cases[4]->appendChild($title->getClone()->setText('5. Frame + Size + Quad + Relative Align'));
$cases[4]->appendChild($frameSize->getClone()->setPosn(10, -10)->appendChild($quad->getClone()->setRelativeAlign('right', 'bottom')));

$cases[5]->appendChild($title->getClone()->setText('6. Frame + Size + Quad + Relative Align + Align'));
$cases[5]->appendChild($frameSize->getClone()->appendChild($quad->getClone()->setRelativeAlign('right', 'bottom')->setAlign('right', 'bottom')));

$cases[6]->appendChild($title->getClone()->setText('7. Frame + Size + Align + Quad'));
$cases[6]->appendChild($frameSizeAlign->getClone()->appendChild($quad->getClone()));

$cases[7]->appendChild($title->getClone()->setText('8. Frame + Size + Align + Quad + Relative Align + Align'));
$cases[7]->appendChild($frameSizeAlign->getClone()->appendChild($quad->getClone()->setRelativeAlign('right', 'bottom')->setAlign('right', 'bottom')));

$cases[8]->appendChild($title->getClone()->setText('9. Frame + Size + Align + Frame + Size'));
$cases[8]->appendChild(
    $frameSizeAlign->getClone()->appendChild(
        $frameSizeSmall->getClone()
    )
);

$cases[9]->appendChild($title->getClone()->setText('10. Frame + Size + Align + Frame + Size + Both Align'));
$cases[9]->appendChild(
    $frameSizeAlign->getClone()->appendChild(
        $frameSizeSmall->getClone()->setBothAlign('right', 'bottom')
    )
);

$cases[10]->appendChild($title->getClone()->setText('11. Frame + Size + Align + Frame + Size + Both Align + Quad'));
$cases[10]->appendChild(
    $frameSizeAlign->getClone()->appendChild(
        $frameSizeSmall->getClone()->setBothAlign('right', 'bottom')->appendChild(
            $quadSmall->getClone()
        )
    )
);

$cases[11]->appendChild($title->getClone()->setText('9. Frame + Size + Align + Frame + Size + Both Align + Quad + Both Align'));
$cases[11]->appendChild(
    $frameSizeAlign->getClone()->appendChild(
        $frameSizeSmall->getClone()->setBothAlign('right', 'bottom')->appendChild(
            $quadSmall->getClone()->setBothAlign('right', 'bottom')
        )
    )
);

return $manialink;
