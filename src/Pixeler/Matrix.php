<?php

/**
 * Pixeler
 *
 * UTF-8 Dot matrix renderer.
 *
 * @package pixeler
 * @author lastguest@gmail.com
 * @version 1.0
 * @copyright Stefano Azzolini - 2014 - http://dreamnoctis.com
 */

namespace Pixeler;

class Matrix {
  protected $matrix = null,
            $colors = null,
            $width  = 0,
            $height = 0,
            $size   = 0,
            $csize  = 0;

  public function __construct($width,$height){
    $this->width    = 2 * ($w2=ceil($width/2));
    $this->height   = 4 * ($h2=ceil($height/4));
    $this->size     = $this->width * $this->height;
    $this->csize    = $w2 * $h2;
    $this->matrix   = new \SplFixedArray($this->size);
    $this->colors   = new \SplFixedArray($this->csize);
  }

  public function clearColors() {
    $this->colors   = new \SplFixedArray($this->csize);
  }

  public function clear() {
    $this->matrix   = new \SplFixedArray($this->size);
    $this->colors   = new \SplFixedArray($this->csize);
  }

  public function setPixel($x, $y, $value = true,$color = null){
    $y = (int)$y; $x = (int)$x;
    if ( $x < $this->width && $y < $this->height) {
      $this->matrix[$x + $y * $this->width] = !! $value;
      $this->colors[$x>>1 + ($y>>2) * $this->width] = $color;
    }
  }

  public function getPixel($x, $y){
    $y = (int)$y; $x = (int)$x;
    if ( $x < $this->width && $y < $this->height) {
      return [ $this->matrix[$x + $y * $this->width], $this->colors[$x + $y * $this->width] ];
    } else {
      return false;
    }
  }

  public function render(){
    $i  = 0;
    $w  = $this->width;
    $w2 = $this->width >> 1;
    $h  = $this->height;
    $m  = $this->matrix;
    $c  = $this->colors;
    $ESC = chr(27);
    ob_start();
    for ($y = 0, $cy = 0; $y < $h; $y += 4, $cy++){
      $cx = 0; $cy0 = $cy * $w2; 
      $y0 = $y * $w; $y1 = ($y + 1) * $w; $y2 = ($y + 2) * $w; $y3 = ($y + 3) * $w;
      for ($x = 0; $x < $w; $x += 2, $cx++){
        $cell = 0;
        $x1   = $x + 1;

        foreach([
          0x01 => $x1 + $y3,
          0x02 => $x  + $y3,
          0x04 => $x1 + $y2,
          0x08 => $x  + $y2,
          0x10 => $x1 + $y1,
          0x20 => $x  + $y1,
          0x40 => $x1 + $y0,
          0x80 => $x  + $y0,
        ] as $bit => $ofs) {
          if (!empty($m[$ofs])) $cell |= $bit;
        }
        
        $dots_r = 0x2800;

        if ($cell & 0x80) $dots_r |= 0x01;
        if ($cell & 0x40) $dots_r |= 0x08;
        if ($cell & 0x20) $dots_r |= 0x02;
        if ($cell & 0x10) $dots_r |= 0x10;
        if ($cell & 0x08) $dots_r |= 0x04;
        if ($cell & 0x04) $dots_r |= 0x20;
        if ($cell & 0x02) $dots_r |= 0x40;
        if ($cell & 0x01) $dots_r |= 0x80;

        $dots_r_64   = $dots_r % 64;
        $dots_r_4096 = $dots_r % 4096;

        // Print UTF-8 character and color
        echo 
         $ESC.'[' . ($c[$cy0+$cx]?'38;5;'.$c[$cy0+$cx]:39).'m'
         . chr(224 + (($dots_r - $dots_r_4096)    >> 12 ))
         . chr(128 + (($dots_r_4096 - $dots_r_64) >> 6  ))
         . chr(128 + $dots_r_64);
      }
      echo $ESC."[0\n";
    }
    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
  }

  public function __toString(){
    return $this->render();
  }

}