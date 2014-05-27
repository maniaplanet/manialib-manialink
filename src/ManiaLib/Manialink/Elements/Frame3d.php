<?php

namespace ManiaLib\Manialink\Elements;

use ManiaLib\Manialink\Layouts\AbstractLayout;

class Frame3d extends Base
{

    protected $nodeName = 'frame3d';

    /**
     * @var AbstractLayout
     */
    protected $layout;

    function __clone()
    {
        parent::__clone();
        if ($this->layout instanceof AbstractLayout) {
            $this->layout = clone $this->layout;
        }
    }

    /**
     * @return \static
     */
    function setStyle3D($style3D)
    {
        return $this->setAttribute("style3d", $style3D);
    }

    function getStyle3D()
    {
        return $this->getAttribute("style3d");
    }

    /**
     * @return AbstractLayout
     */
    function getLayout()
    {
        return $this->layout;
    }

    /**
     * @return \static
     */
    function setLayout(AbstractLayout $layout)
    {
        $this->layout = $layout->setParent($this);
        return $this;
    }

}
