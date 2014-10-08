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
], getopt("f:r:w:i"));

// An image file/url is required.
$opts['f'] or die("Must specify an image file.\n");

// The Pixeler\Image instance render itself if casted to a string

echo Pixeler\Pixeler::image($opts['f'], $opts['r'], isset($opts['i']), $opts['w']);
```

```bash
$ php pixel.php -f http://blog.circleci.com/wp-content/uploads/2014/07/elephant.jpg -r 0.3 -w 0.5
```

<img src="http://cl.ly/image/1W2B0i2X3f01/pixeler_demo.png" width="700" />


```bash
$ php pixel.php -f http://flippywall.com/wp-content/uploads/2014/07/Manga-Girl-Wallpaper-16.jpg -r 0.15 -w 0.5 -i
```

<img src="http://drop.caffeina.co/image/471V2N1J1R1r/pixlr-color.png" width="700" />
