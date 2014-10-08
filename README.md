# Pixeler

UTF-8 Dot matrix renderer, now in color too.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lastguest/pixeler/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lastguest/pixeler/?branch=master)
[![Total Downloads](https://poser.pugx.org/lastguest/pixeler/downloads.svg)](https://packagist.org/packages/lastguest/pixeler)
[![Latest Stable Version](https://poser.pugx.org/lastguest/pixeler/v/stable.svg)](https://packagist.org/packages/lastguest/pixeler)
[![Latest Unstable Version](https://poser.pugx.org/lastguest/pixeler/v/unstable.svg)](https://packagist.org/packages/lastguest/pixeler)
[![License](https://poser.pugx.org/lastguest/pixeler/license.svg)](https://packagist.org/packages/lastguest/pixeler)

<img src="http://f.cl.ly/items/3P212W0G0S0m0s1d3w1r/code.gif" width="700" />

## Installation

Add package to your **composer.json**:

```json
{
  "require": {
    "lastguest/pixeler": "dev-master"
  }
}
```

Run [composer](https://getcomposer.org/download/):

```bash
$ php composer.phar install -o
```

### Example

Create a file `pixel.php` :

```php
<?php

// Vendors
include __DIR__."/vendor/autoload.php";

// Parse options from command line
$opts = array_merge([
    'f' => false, 
    'r' => 1.0,  // Resize factor 1.0 = 100%
    'w' => 0.75, // Dither treshold weight
], getopt("f:r:w:ib"));

// An image file/url is required.
$opts['f'] || die("Must specify an image file.\n");

$image = Pixeler\Pixeler::image($opts['f'], $opts['r'], isset($opts['i']), $opts['w']);

// No colors if "-b" is passed
isset($opts['b']) && $image->clearColors();

// The Pixeler\Image instance render itself if casted to a string
echo $image;
```


```bash
$ php -f http://drop.caffeina.co/image/160L0Y3C0a29/vocaloid.jpg -r .25 -w 0.25 -i
```

<img src="http://drop.caffeina.co/image/1B133A0N3V0c/vocal.png" width="700" />

```bash
$ php pixel.php -f http://flippywall.com/wp-content/uploads/2014/07/Manga-Girl-Wallpaper-16.jpg -r 0.15 -w 0.5 -i
```

<img src="http://drop.caffeina.co/image/471V2N1J1R1r/pixlr-color.png" width="700" />

```bash
$ php pixel.php -f http://blog.circleci.com/wp-content/uploads/2014/07/elephant.jpg -r 0.3 -w 0.5 -b
```

<img src="http://cl.ly/image/1W2B0i2X3f01/pixeler_demo.png" width="700" />


### Animation Example

You will see a lot of tearing, need some kind of vsync wait.

```php
<?php

// Vendors
include __DIR__."/vendor/autoload.php";

$screen = new Pixeler\Canvas(320,100);
$sh2 = $screen->height()/2;
$sh4 = $sh2/1.5;
$ph = pi()/32;
$i = 0;

// To exit, press Ctr-C
while(1){
  $screen->clear();
  for ($x=0,$c=$screen->width(); $x < $c; $x++){
    $y = $sh4*sin($i++/128 + $ph*$x);
    $screen->setPixel($x,$sh2 + $y);
    $screen->setPixel($x,$sh2 + $y/2);
    $screen->setPixel($x,$sh2 + $y/4);
    $screen->setPixel($x,$sh2);
  }
  echo $screen;
}
```

<img src="http://f.cl.ly/items/3P212W0G0S0m0s1d3w1r/code.gif" width="700" />
