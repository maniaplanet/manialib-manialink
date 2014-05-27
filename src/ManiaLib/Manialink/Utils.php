<?php

namespace ManiaLib\Manialink;

use ManiaLib\Manialink\Elements\Base;

abstract class Utils
{

    /**
     * Returns the X position of an element in relation to another element and
     * according to their respective alignments
     * 
     * @param int X position of the parent element
     * @param int Width of the parent element
     * @param string Horizontal alignement of the parent element
     * @param string Horizontal alignement of the element you want to place
     * @return int Calculated X position of the element you want to place
     */
    final public static function getAlignedPosX($posX, $sizeX, $halign, $newAlign)
    {
        if (!$halign) {
            $halign = 'left';
        }
        $alignmentString = $halign . '|' . $newAlign;
        switch ($alignmentString) {
            case 'center|center':
            case 'center|center2':
            case 'left|left':
            case 'right|right':
                $factor = 0;
                break;

            case 'center|left':
            case 'right|center':
            case 'right|center2':
                $factor = -0.5;
                break;

            case 'center|right':
            case 'left|center':
            case 'left|center2':
                $factor = 0.5;
                break;

            case 'left|right':
                $factor = 1;
                break;

            case 'right|left':
                $factor = -1;
                break;

            default:
                throw new Exception('Unsupported positions: ' . $alignmentString);
        }
        return $posX + $factor * $sizeX;
    }

    /**
     * Returns the Y position of an element in relation to another element and
     * according to their respective alignments
     * 
     * @param int Y position of the parent element
     * @param int Height of the parent element
     * @param string Vertical alignement of the parent element
     * @param string Vertical alignement of the element you want to place
     * @return int Calculated Y position of the element you want to place
     */
    final public static function getAlignedPosY($posY, $sizeY, $valign, $newAlign)
    {
        switch ($valign) {
            case 'top':
            case null:
                $valign = 'right';
                break;

            case 'bottom':
                $valign = 'left';
                break;
        }
        switch ($newAlign) {
            case 'top':
                $newAlign = 'right';
                break;

            case 'bottom':
                $newAlign = 'left';
                break;
        }
        return self::getAlignedPosX($posY, $sizeY, $valign, $newAlign);
    }

    /**
     * Returns the position of an element in relation to another element and
     * according to their respective alignments
     * 
     * @param Base Parent element
     * @param string Horizontal alignement of the element you want to place
     * @param string Vertical alignement of the element you want to place
     * @return array Calculated position of the element you want to place. The
     * array contains 2 elements with "x" and "y" indexes
     */
    final public static function getAlignedPos(Base $object, $newHalign, $newValign)
    {
        $newPosX = self::getAlignedPosX(
                $object->getPosnX(), $object->getRealSizeX(), $object->getHalign(), $newHalign);
        $newPosY = self::getAlignedPosY(
                $object->getPosnY(), $object->getRealSizeY(), $object->getValign(), $newValign);
        return array('x' => $newPosX, 'y' => $newPosY);
    }

}
