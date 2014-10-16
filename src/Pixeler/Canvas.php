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

class Canvas {
  protected $screen;
  protected $width;
  protected $height;
  protected $charHeight;
  
  public function __construct($w,$h){
    $this->screen = new Matrix($this->width=$w,$this->height=$h);
    $this->charHeight = ceil($h/4);
  }

  public function clear($clear=true){
    static $ESC;
    $ESC or $ESC = chr(27);
    $this->screen->clear();
    $h = $this->charHeight +1;
    echo $ESC,'[',$h,'A';
  }
  
  public function setPixel($x,$y,$c=1){
    $this->screen->setPixel($x,$y,$c);
  }

  public function width(){
    return $this->width;
  }  

  public function height(){
    return $this->height;
  }  
  
  public function __toString(){
    return $this->screen->render();
  }  
     
}