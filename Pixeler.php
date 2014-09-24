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

  public static function image($image_url, $resize_factor = 1.0, $invert = false, $weight = 0.5){
    return new PixelerImage($image_url, $resize_factor, $invert, $weight);
  }

  public static function dots($width, $height){
    return new PixelerMatrix($width, $height);
  }

}

class PixelerMatrix {
  protected $matrix = [],
            $width  = 0,
            $height = 0,
            $size   = 0;
  
  public function __construct($width,$height){
    $this->width    = 2 * ceil($width/2);
    $this->height   = 4 * ceil($height/4);
    $this->size     = $this->width * $this->height;
    $this->matrix   = new \SplFixedArray($this->size);
  }
  
  public function setPixel($x, $y, $value){
    if ( $x < $this->width && $y < $this->height) {
      $this->matrix[$x + $y * $this->width] = !! $value;
    }
  }

  public function getPixel($x, $y){
    if ( $x < $this->width && $y < $this->height) {
      return $this->matrix[$x + $y * $this->width];
    } else {
      return false;
    }
  }

  public function render(){
    $buff = [];
    $w = $this->width;
    for ($y = 0; $y < $this->height; $y += 4){
      $y0 = $y * $w; $y1 = ($y + 1) * $w; $y2 = ($y + 2) * $w; $y3 = ($y + 3) * $w;
      for ($x = 0; $x < $this->width; $x += 2){
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

          if(!empty($this->matrix[$ofs])) $cell |= $bit;
        }

        $buff[] = static::dots($cell);
      }
      $buff[] = "\n";
    }
    return implode('',$buff);
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

    $dots_r_64   = $dots_r % 64;
    $dots_r_4096 = $dots_r % 4096;

    // Print UTF-8 character
    return chr(224 + (($dots_r - $dots_r_4096) >> 12 ))
         . chr(128 + (($dots_r_4096 - $dots_r_64) >> 6 ))
         . chr(128 + $dots_r_64); 
  }

}


class PixelerImage extends PixelerMatrix {
  
  public function __construct($img, $resize=1.0, $invert=false, $weight = 0.5){
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    if ($ext == 'jpg') $ext = 'jpeg';
    $creator = 'imagecreatefrom'.$ext;

    if (!function_exists($creator)) throw new \Exception("Image format not supported.", 1);
    
    $im = $creator($img);
    $w = imagesx($im);
    $h = imagesy($im);

    
    // Resize image
    if ( $resize != 1.0 ){
      $nw = ceil($resize * $w);
      $nh = ceil($resize * $h);
      $new_img = imagecreatetruecolor($nw, $nh);
      imagesavealpha($new_img, true);
      imagealphablending($new_img, false);
      imagefill($new_img, 0, 0, imagecolorallocate($new_img,255,255,255));
      imagecopyresized($new_img,$im,0,0,0,0,$nw,$nh,$w,$h);
      imagedestroy($im);
      $im = $new_img;
      $w = $nw; $h = $nh;
    }

    // Init Dot Matrix
    parent::__construct($w,$h);

    imagefilter($im, IMG_FILTER_GRAYSCALE);
    if ($invert) imagefilter($im, IMG_FILTER_NEGATE);

    // 1-bit Atkinson dither
    // Adapted from : https://gist.github.com/lordastley/1342627

    $pixels = new \SplFixedArray($w * $h);
    for($y=0; $y < $h; $y++){
        for($x=0; $x < $w; $x++){
            $pixels[$x + $y * $w] = imagecolorat($im, $x, $y);
        }
    }
    imagedestroy($im);

    $c1_8 = 1/8;
    $tresh = (0xffffff * $weight) & 0xffffff;
    for ($y=0; $y < $h; $y++){
        $y0 = $y * $w; $y1 = ($y + 1) * $w; $y2 = ($y + 2) * $w;
        for ($x=0; $x < $w; $x++){
            $old = $pixels[$x + $y * $w];

            if ($old > $tresh){
                $new = 0xffffff;
            } else {
                $new = 0x000000;
                $this->matrix[$x + $y0] = true;
            }
            
            $error_diffusion = $c1_8 * ($old - $new);
            
            $x1 = $x + 1; $x2 = $x + 2; $x_1 = $x - 1;
            
            foreach([$x1 + $y0, $x2 + $y0, $x_1 + $y1, $x + $y1, $x1 + $y1, $x + $y2] as $ofs) {
              if (isset($pixels[$ofs])) $pixels[$ofs] += $error_diffusion;
            }
            
        }
    }   
  }

}

