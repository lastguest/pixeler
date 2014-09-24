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

class Pixeler {

  public static function image($image_url, $resize_factor = 1.0, $invert = false){
    return new PixelerImage($image_url, $resize_factor, $invert);
  }

  public static function dots($width, $height){
    return new PixelerMatrix($width, $height);
  }

}

class PixelerMatrix {
  protected $matrix = [],
            $width = 0,
            $height = 0,
            $size = 0;
  
  public function __construct($width,$height){
    $this->width    = 2*ceil($width/2);
    $this->height   = 4*ceil($height/4);
    $this->size     = $this->width * $this->height;
    $this->matrix   = new SplFixedArray($this->size);
  }
  
  public function setPixel($x, $y, $value){
    if ( $x < $this->width && $y < $this->height) {
      $this->matrix[$x+$y*$this->height] = !!$value;
    }
  }

  public function getPixel($x, $y){
    if ( $x < $this->width && $y < $this->height) {
      return $this->matrix[$x+$y*$this->height];
    } else {
      return false;
    }
  }

  public function render(){
    $buff = '';
    for ($y = 0; $y < $this->height; $y += 4){
      for ($x = 0; $x < $this->width; $x += 2){
        $cell = 0;
        $x1 = $x + 1;
        $y1 = $y + 1; $y2 = $y + 2; $y3 = $y + 3;
        if ($this->getPixel($x , $y )) $cell  = 0x80;
        if ($this->getPixel($x , $y1)) $cell |= 0x20;
        if ($this->getPixel($x , $y2)) $cell |= 0x08;
        if ($this->getPixel($x , $y3)) $cell |= 0x02;
        if ($this->getPixel($x1, $y )) $cell |= 0x40;
        if ($this->getPixel($x1, $y1)) $cell |= 0x10;
        if ($this->getPixel($x1, $y2)) $cell |= 0x04;
        if ($this->getPixel($x1, $y3)) $cell |= 0x01;
        $buff .= static::dots($cell);
      }
      $buff .= "\n";
    }
    return $buff;
  }

  public function __toString(){
    return $this->render();
  }

  protected static function dots($dots){
    $dots_r = 0x2800;
    if ($dots & 0x80) $dots_r |= 0x01;
    if ($dots & 0x40) $dots_r |= 0x08;
    if ($dots & 0x20) $dots_r |= 0x02;
    if ($dots & 0x10) $dots_r |= 0x10;
    if ($dots & 0x08) $dots_r |= 0x04;
    if ($dots & 0x04) $dots_r |= 0x20;
    if ($dots & 0x02) $dots_r |= 0x40;
    if ($dots & 0x01) $dots_r |= 0x80;
    return chr(224 + (($dots_r - ($dots_r % 4096)) / 4096))
         . chr(128 + ((($dots_r % 4096) - ($dots_r % 64)) / 64))
         . chr(128 + ($dots_r % 64)); 
  }

}


class PixelerImage extends PixelerMatrix {
  protected $image;
  
  public function __construct($img, $resize=1.0, $invert=false){
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    if ($ext == 'jpg') $ext = 'jpeg';
    $creator = 'imagecreatefrom'.$ext;
    if (!function_exists($creator)) throw new Exception("Image format not supported.", 1);
    
    $im = $creator($img);
    $w = imagesx($im);
    $h = imagesy($im);

    // Resize image
    if ( $resize != 1.0 ){
      $nw = ceil($resize*$w);
      $nh = ceil($resize*$h);
      $new_img = imagecreatetruecolor($nw, $nh);
      imagealphablending($new_img, false);
      imagesavealpha($new_img, true);
      imagefill($new_img, 0, 0, imagecolorallocate($new_img,255,255,255));
      imagecopyresized($new_img,$im,0,0,0,0,$nw,$nh,$w,$h);
      imagedestroy($im);
      $im = $new_img;
      $w = $nw; $h = $nh;
    }

    parent::__construct($w,$h);

    imagefilter($im, IMG_FILTER_GRAYSCALE);
    if ($invert) imagefilter($im, IMG_FILTER_NEGATE);

    // 1-bit Atkinson dither
    // https://gist.github.com/lordastley/1342627

    $pixels = [];
    for($y=0; $y < $h; $y++){
        for($x=0; $x < $w; $x++){
            $pixels[$x][$y] = imagecolorat($im, $x, $y);
        }
    }
    imagedestroy($im);

    $c1_8 = 1/8;
    $tresh = (0xffffff * 0.5) & 0xffffff;
    for ($y=0; $y < $h; $y++){
        for ($x=0; $x < $w; $x++){
            $old = $pixels[$x][$y];
            if ($old > $tresh){
                $new = 0xffffff;
            } else {
                $new = 0x000000;
                $this->setPixel($x, $y, 1);
            }
            $error_diffusion = $c1_8 * ($old - $new);
            if (isset($pixels[$x+1][$y  ])) $pixels[$x+1][$y  ] += $error_diffusion;
            if (isset($pixels[$x+2][$y  ])) $pixels[$x+2][$y  ] += $error_diffusion;
            if (isset($pixels[$x-1][$y+1])) $pixels[$x-1][$y+1] += $error_diffusion;
            if (isset($pixels[$x  ][$y+1])) $pixels[$x  ][$y+1] += $error_diffusion;
            if (isset($pixels[$x+1][$y+1])) $pixels[$x+1][$y+1] += $error_diffusion;
            if (isset($pixels[$x  ][$y+2])) $pixels[$x  ][$y+2] += $error_diffusion;
        }
    }   
  }

}

