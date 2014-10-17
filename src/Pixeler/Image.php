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

class Image extends Matrix {
  const DITHER_NONE = 0,
        DITHER_ERROR = 1;

  public function __construct($img, $resize=1.0, $invert=false, $weight = 0.5, $dither=self::DITHER_ERROR){
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    if ($ext == 'jpg') $ext = 'jpeg';
    $imagecreator = 'imagecreatefrom' . $ext;

    if (!function_exists($imagecreator)) 
      throw new \Exception('Image format not supported.', 1);

    $im = $imagecreator($img);
    $w  = imagesx($im);
    $h  = imagesy($im);

    // Resize image
    $nw       = ceil($resize * $w);
    $nh       = ceil($resize * $h * 0.75);
    $new_img  = imagecreatetruecolor($nw, $nh);
    imagesavealpha     ($new_img, true);
    imagealphablending ($new_img, false);
    imagefill          ($new_img, 0, 0, imagecolorallocate($new_img, 255, 255, 255));
    imagecopyresized   ($new_img, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
    imagedestroy       ($im);
    $im = $new_img;
    $w = $nw; $h = $nh;

    // Init Dot Matrix
    parent::__construct($w, $h);

    // Create the color matrix
    $color_img_w = ceil($w/2);
    $color_img_h = ceil($h/4);

    // Lower precision -> faster palette lookup -> uglier colors.
    $min_color_precision = 20;

    $color_img = imagecreatetruecolor($color_img_w, $color_img_h);
    imagesavealpha      ($color_img, true);
    imagealphablending  ($color_img, false);
    imagefill           ($color_img, 0, 0, imagecolorallocate($color_img, 255, 255, 255));
    imagecopyresized    ($color_img, $im, 0, 0, 0, 0, $color_img_w, $color_img_h, $w, $h);

    // ANSI 8bit Palette
    $ansi256palette = [
      0x000000,0x800000,0x008000,0x808000,0x000080,0x800080,0x008080,0xc0c0c0,
      0x808080,0xff0000,0x00ff00,0xffff00,0x0000ff,0xff00ff,0x00ffff,0xffffff,
      0x000000,0x00005f,0x000087,0x0000af,0x0000d7,0x0000ff,0x005f00,0x005f5f,
      0x005f87,0x005faf,0x005fd7,0x005fff,0x008700,0x00875f,0x008787,0x0087af,
      0x0087d7,0x0087ff,0x00af00,0x00af5f,0x00af87,0x00afaf,0x00afd7,0x00afff,
      0x00d700,0x00d75f,0x00d787,0x00d7af,0x00d7d7,0x00d7ff,0x00ff00,0x00ff5f,
      0x00ff87,0x00ffaf,0x00ffd7,0x00ffff,0x5f0000,0x5f005f,0x5f0087,0x5f00af,
      0x5f00d7,0x5f00ff,0x5f5f00,0x5f5f5f,0x5f5f87,0x5f5faf,0x5f5fd7,0x5f5fff,
      0x5f8700,0x5f875f,0x5f8787,0x5f87af,0x5f87d7,0x5f87ff,0x5faf00,0x5faf5f,
      0x5faf87,0x5fafaf,0x5fafd7,0x5fafff,0x5fd700,0x5fd75f,0x5fd787,0x5fd7af,
      0x5fd7d7,0x5fd7ff,0x5fff00,0x5fff5f,0x5fff87,0x5fffaf,0x5fffd7,0x5fffff,
      0x870000,0x87005f,0x870087,0x8700af,0x8700d7,0x8700ff,0x875f00,0x875f5f,
      0x875f87,0x875faf,0x875fd7,0x875fff,0x878700,0x87875f,0x878787,0x8787af,
      0x8787d7,0x8787ff,0x87af00,0x87af5f,0x87af87,0x87afaf,0x87afd7,0x87afff,
      0x87d700,0x87d75f,0x87d787,0x87d7af,0x87d7d7,0x87d7ff,0x87ff00,0x87ff5f,
      0x87ff87,0x87ffaf,0x87ffd7,0x87ffff,0xaf0000,0xaf005f,0xaf0087,0xaf00af,
      0xaf00d7,0xaf00ff,0xaf5f00,0xaf5f5f,0xaf5f87,0xaf5faf,0xaf5fd7,0xaf5fff,
      0xaf8700,0xaf875f,0xaf8787,0xaf87af,0xaf87d7,0xaf87ff,0xafaf00,0xafaf5f,
      0xafaf87,0xafafaf,0xafafd7,0xafafff,0xafd700,0xafd75f,0xafd787,0xafd7af,
      0xafd7d7,0xafd7ff,0xafff00,0xafff5f,0xafff87,0xafffaf,0xafffd7,0xafffff,
      0xd70000,0xd7005f,0xd70087,0xd700af,0xd700d7,0xd700ff,0xd75f00,0xd75f5f,
      0xd75f87,0xd75faf,0xd75fd7,0xd75fff,0xd78700,0xd7875f,0xd78787,0xd787af,
      0xd787d7,0xd787ff,0xd7af00,0xd7af5f,0xd7af87,0xd7afaf,0xd7afd7,0xd7afff,
      0xd7d700,0xd7d75f,0xd7d787,0xd7d7af,0xd7d7d7,0xd7d7ff,0xd7ff00,0xd7ff5f,
      0xd7ff87,0xd7ffaf,0xd7ffd7,0xd7ffff,0xff0000,0xff005f,0xff0087,0xff00af,
      0xff00d7,0xff00ff,0xff5f00,0xff5f5f,0xff5f87,0xff5faf,0xff5fd7,0xff5fff,
      0xff8700,0xff875f,0xff8787,0xff87af,0xff87d7,0xff87ff,0xffaf00,0xffaf5f,
      0xffaf87,0xffafaf,0xffafd7,0xffafff,0xffd700,0xffd75f,0xffd787,0xffd7af,
      0xffd7d7,0xffd7ff,0xffff00,0xffff5f,0xffff87,0xffffaf,0xffffd7,0xffffff,
      0x080808,0x121212,0x1c1c1c,0x262626,0x303030,0x3a3a3a,0x444444,0x4e4e4e,
      0x585858,0x606060,0x666666,0x767676,0x808080,0x8a8a8a,0x949494,0x9e9e9e,
      0xa8a8a8,0xb2b2b2,0xbcbcbc,0xc6c6c6,0xd0d0d0,0xdadada,0xe4e4e4,0xeeeeee
    ];

    $colormap = [];
    foreach ($ansi256palette as $rgb) $colormap[] = [
      ($rgb >> 16) & 0xFF,
      ($rgb >> 8)  & 0xFF,
      ($rgb)       & 0xFF
    ];
    $ansi256palette = $colormap;
    $colormap = [];

    // Find nearest match of passed RGB with ANSI palette 
    $nearest = function($rgb) use ($ansi256palette, $min_color_precision){
      $best = 0; $dist = 10000;
      foreach ($ansi256palette as $idx => $a) {
        $d = sqrt(
          pow($rgb['red']-$a[0],2) + pow($rgb['green']-$a[1],2) + pow($rgb['blue']-$a[2],2)
        );
        if($d < $dist) {
          $dist = $d;
          $best = $idx;
          if($d <= $min_color_precision) break;
        }
      }
      return $best;
    };

    // Read colors
    $c = $this->colors;
    for($y = $color_img_h; $y--;){
      $y0 = $y * $color_img_w;
      for($x = $color_img_w; $x-- ;){
        $c[ $y0 + $x ] = $nearest(imagecolorsforindex($color_img,imagecolorat($color_img, $x, $y)));
      }
    }
    $this->colors = $c;
    imagedestroy($color_img);

    // Invert image for dark backgrounds
    if ($invert) imagefilter($im, IMG_FILTER_NEGATE);


    $pixels = new \SplFixedArray($w * $h);
    for($y = $h ; $y-- ;){
      for($x = $w, $y0 = $y * $w ; $x-- ;){
            $pixels[$x + $y0] = imagecolorat($im, $x, $y);
        }
    }
    imagedestroy($im);

    $m = $this->matrix;
    switch($dither){

      // Threshold 1-bit quantization
      case self::DITHER_NONE:
      default:
        $tresh = (0xffffff * $weight) & 0xffffff;
        $b = $invert?1:0;
        for ($y=0; $y < $h; $y++){
            $y0 = $y * $w; $y1 = $y0 + $w; $y2 = $y1 + $w;
            for ($x=0; $x < $w; $x++) {
                $idx = $x + $y0;
                $m[$idx] = $pixels[$idx]<=$tresh?$pixels[$idx]:$b;
              }
        }
      break;

      // Dither image with 1-bit Atkinson Dithering
      // Adapted from : https://gist.github.com/lordastley/1342627
      case self::DITHER_ERROR:
        $tresh = (0xffffff * $weight) & 0xffffff;
        for ($y=0; $y < $h; $y++){
            $y0 = $y * $w; $y1 = $y0 + $w; $y2 = $y1 + $w;
            for ($x=0; $x < $w; $x++) {
                $idx = $x + $y0;
                $old = $pixels[$idx];
                
                if ($old > $tresh){
                    $error_diffusion = ($old - 0xffffff) >> 3;
                } else {
                    $error_diffusion = $old >> 3;
                    $m[$idx] = $old;
                }


                $x1 = $x + 1; $x2 = $x + 2; $x_1 = $x - 1;

                foreach([
                    $x1  + $y0,
                    $x2  + $y0,
                    $x_1 + $y1,
                    $x   + $y1,
                    $x1  + $y1,
                    $x   + $y2,
                ] as $ofs) {
                  if (isset($pixels[$ofs])) $pixels[$ofs] += $error_diffusion;
                }
            }
        }

      break;
    }

  }

}