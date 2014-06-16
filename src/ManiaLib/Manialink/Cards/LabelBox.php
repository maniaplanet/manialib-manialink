<?php

namespace ManiaLib\Manialink\Cards;

use ManiaLib\Manialink\Elements\Label;

class LabelBox extends Box
{

    /**
     * @var Label
     */
    protected $label;

    function __construct()
    {
        parent::__construct();
        $this->label = Label::create()
            ->setBothAlign('center', 'center')
            ->setPosn(0, 0, 0.1)
            ->appendTo($this);
    }

    public function preFilterSize()
    {
        parent::preFilterSize();

        if (!$this->label->getSizenX() && !$this->label->getSizenY()) {
            $this->label->setSizen($this->getSizenX(), $this->getSizenY());
        }
    }

    /**
     * @return Label
     */
    function getLabel()
    {
        return $this->label;
    }

}
