<?php

namespace ManiaLib\Manialink\Layouts;

class Flow extends AbstractLayout
{

    protected $maxHeight               = 0;
    protected $currentLineElementCount = 0;

    function preFilter(\ManiaLib\Manialink\Elements\Base $node)
    {
        // flo: added 0.1 because of floating mistakes
        $availableWidth = $this->parent->getSizenX() - $this->xIndex - $this->borderWidth + 0.1;

        // If end of the line is reached
        if ($availableWidth < $node->getRealSizenX() & $this->currentLineElementCount > 0) {
            $this->yIndex -= $this->maxHeight + $this->marginHeight;
            $this->xIndex                  = $this->borderWidth;
            $this->currentLineElementCount = 0;
            $this->maxHeight               = 0;
        }
    }

    function postFilter(\ManiaLib\Manialink\Elements\Base $node)
    {
        $this->xIndex += $node->getRealSizenX() + $this->marginWidth;
        if (!$this->maxHeight || $node->getRealSizenY() > $this->maxHeight) {
            $this->maxHeight = $node->getRealSizenY();
        }
        $this->currentLineElementCount++;
    }

}
