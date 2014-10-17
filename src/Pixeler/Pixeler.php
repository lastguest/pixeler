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

class Pixeler {

  public static function image($image_url, $resize_factor = 1.0, $invert = false, $weight = 0.5, $mode = Image::DITHER_ERROR){
    return new Image($image_url, $resize_factor, $invert, $weight, $mode);
  }

  public static function dots($width, $height){
    return new Matrix($width, $height);
  }

  public static function hide_cursor(){
      echo chr(27).'[?25l';
  }
  
  public static function show_cursor(){
      echo chr(27).'[?25h';
  }

}