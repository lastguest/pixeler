# Pixeler

UTF-8 Dot matrix renderer.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lastguest/pixeler/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lastguest/pixeler/?branch=master)
[![Total Downloads](https://poser.pugx.org/lastguest/pixeler/downloads.svg)](https://packagist.org/packages/lastguest/pixeler)
[![Latest Stable Version](https://poser.pugx.org/lastguest/pixeler/v/stable.svg)](https://packagist.org/packages/lastguest/pixeler)
[![Latest Unstable Version](https://poser.pugx.org/lastguest/pixeler/v/unstable.svg)](https://packagist.org/packages/lastguest/pixeler)
[![License](https://poser.pugx.org/lastguest/pixeler/license.svg)](https://packagist.org/packages/lastguest/pixeler)


```
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣀⣀⣀⣀⣀⣀⣀⣀⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣀⣴⣿⣟⡿⣯⣟⣿⣻⣟⣿⣻⣟⡿⣷⣦⣤⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣨⣿⣟⡿⣾⣽⣻⢷⣻⣞⣷⣻⣞⡷⣯⣟⡷⣯⣷⣎⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⣹⡷⣯⣟⡷⣯⣟⣯⡷⣟⡾⣷⢯⣟⡷⣯⣟⣷⣻⢾⣧⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢸⣿⣽⣳⣯⣟⣷⣻⢾⣽⣻⣽⢯⡿⣽⣻⢷⣻⡾⣽⣻⢾⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣼⣟⣾⣳⣟⣾⣳⣟⣯⡷⣟⣾⣻⡽⣷⣻⢯⣷⣟⣯⣟⡿⣧⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⣿⣽⣞⣷⣛⠾⣽⢾⡳⠟⣯⣧⣛⠙⠷⠟⣿⢾⡽⣾⣽⣻⣽⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢰⣿⣳⡏⢀⣙⡓⠤⠉⠛⠓⠂⠈⠙⠓⠄⠀⢀⣀⣈⠉⢾⣳⢿⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣿⣳⡇⠀⢩⠭⣭⠽⢓⠦⠀⠀⠀⠔⡚⢯⡭⠭⠍⠀⢸⣯⣯⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠇⠒⣯⡇⠀⠀⠑⠒⠂⠁⢀⠴⠛⢶⣄⡈⠒⠒⠈⠀⠀⣾⣷⠂⢹⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⡇⠐⢯⣷⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠙⢿⣻⡒⠀⠀⠀⣿⡞⡆⡸⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⢌⠚⢹⡀⠀⠀⠀⠀⢠⣢⡀⠀⣠⣴⠀⠈⠙⢆⠀⢰⡟⢂⡴⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⢹⣷⡀⠠⢐⣨⣴⣶⢿⡿⣟⣶⣦⣄⠀⡈⢠⣿⠉⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣿⣻⣦⣿⠏⠕⠒⠒⠒⠒⠒⠍⢻⣷⣴⣿⣻⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣄⣀⣀⣴⣤⣠⣦⣄⣀⡟⣷⣻⢾⣀⠄⠲⣶⣷⡶⠆⠐⣰⡿⣞⡷⣯⣀⣤⣦⠀⣠⣶⣶⠀⢀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⣤⣄⣀⣹⣿⣻⣟⣯⢿⣽⣳⢟⡿⡇⠈⢿⣯⣟⡿⣟⡿⣾⡽⣿⢿⣻⣽⡏⠁⣿⡽⢯⣟⣿⣻⣽⢾⣟⡿⣟⣀⣤⣄⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⢿⣻⣟⡿⣞⣷⣻⢾⣻⡾⣽⣻⢮⣕⡢⢄⡉⠺⣿⣽⣻⢷⣻⡽⣯⠟⢈⡠⢖⣫⣵⢿⣻⣞⡷⣯⢿⣞⡿⣽⢯⣟⣧⣤⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⢴⣿⣟⡷⣯⢿⣽⣞⣯⢿⣳⡿⣽⢯⡿⣽⣻⣶⣍⡒⢬⡁⠉⠉⠉⢉⡤⢚⣩⣾⣻⣽⢾⣻⢷⣯⢿⣽⣻⣞⡿⣽⣯⣟⡾⣧⣄⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠠⣤⣽⣞⡿⣽⣻⢾⣽⢾⣻⣽⣻⡽⣯⢿⣽⣳⣟⡾⣟⣶⣌⡓⠬⢚⣥⣶⢿⣻⣞⡷⣯⣟⣯⢿⣞⣯⡷⣯⢿⡽⣷⣻⣞⣿⣳⢯⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⢰⣿⢾⣽⣻⡽⣯⢿⣞⡿⣽⣞⡷⣟⣯⡿⣾⡽⣞⣿⣽⣳⣯⢿⠀⣿⣻⣞⣿⣳⣯⣟⡷⣯⣟⡿⣾⣽⣻⡽⣯⣟⡷⣟⣾⣳⣟⣋⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⣈⣿⣞⡷⣿⣽⣻⣞⡿⣽⣞⡿⣽⣳⢿⡳⣟⡿⣞⣷⣻⢾⣻⠀⣿⣳⣟⣾⣳⣟⣾⣻⢷⣯⣟⡷⣯⢷⡿⣽⣞⡿⣽⣳⣟⣾⡁⠀⠀⠀⠀⠀⠀
⠀⠀⢀⣴⣿⣟⡷⣯⣟⡷⣯⢷⣻⣽⣟⣾⣻⡽⣯⣟⡿⣮⣝⢿⢾⣽⣻⣽⠀⣿⣳⣟⣾⡳⣫⢾⣽⣻⢾⣽⣻⡽⣯⣟⡷⣯⢿⣽⣳⢿⣞⡿⣷⣤⡀⠀⠀⠀
⠀⢰⣾⣟⡷⣯⣟⡷⣯⢿⣽⣻⣽⢾⡽⣶⡻⣽⢷⣯⢿⣽⣞⡷⣌⡛⢷⣻⠀⣟⡷⢛⣴⡾⣽⣻⢾⣽⣻⣞⢧⣿⣻⣞⡿⣽⣻⢾⣽⣻⣞⣿⣳⢯⣷⡄⠀⠀
⠀⣸⣟⡾⠹⢷⣯⢿⣽⣻⢾⣽⢾⣯⣟⣷⣳⡍⣿⣞⡿⣾⣽⣻⣽⣻⢦⡙⠀⢋⣴⣟⣷⣻⡽⣯⢿⣞⡷⢣⣟⣾⣳⣯⢿⡽⣯⢿⣞⣷⣻⣞⠯⢿⣞⡇⠀⠀
⢠⡿⣽⣻⢾⣭⢨⡿⣾⣽⣻⢾⣻⢾⡽⣞⣷⣻⣎⢺⣟⡷⣯⢷⣯⣟⣯⢿⢀⣿⣻⣞⡷⣯⢿⣽⣻⠎⣴⢿⡽⣞⣷⢯⣟⡿⣽⣻⢾⡽⡇⣭⣷⣻⣽⣳⡀⠀
⣼⣟⣷⣻⣟⡾⣯⣭⣡⡽⣯⣟⣯⣟⡿⣽⣳⣟⡾⣧⡙⠿⣽⣻⢾⡽⣾⣻⢰⣯⢷⣻⣽⣻⣟⠞⣡⣞⣯⡿⣽⣻⢾⣻⣽⣻⡽⣧⣬⣿⣻⢷⣯⢷⣯⣟⣇⠀
⠿⠾⠽⠳⠯⠿⠽⠳⠿⠽⠳⠿⠾⠽⠻⠽⠳⠯⠟⠷⠿⠦⠉⠿⠯⠟⠷⠿⠸⠯⠟⠿⠞⠗⠡⠾⠻⠞⠷⠿⠽⠯⠿⠽⠞⠷⠿⠽⠳⠯⠟⠿⠞⠿⠾⠽⠾⠀
```

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

$opts = array_merge([
	'f' => false,
	// Resize factor 1.0 = 100%
	'r' => 1.0,
	// Dither treshold weight
	'w' => 0.75,
], getopt("f:r:w:i"));

$opts['f'] or die("Must specify an image file.\n");

// The PixelerImage instance render itself if casted to a string
echo Pixeler::image($opts['f'], $opts['r'], isset($opts['i']), $opts['w']);
```

```bash
$ php pixel.php -f http://blog.circleci.com/wp-content/uploads/2014/07/elephant.jpg -r 0.3 -w 0.5
```

Output:

<img src="http://cl.ly/image/1W2B0i2X3f01/pixeler_demo.png" width="700" />

