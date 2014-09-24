# Pixeler

UTF-8 Dot matrix renderer.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lastguest/pixeler/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lastguest/pixeler/?branch=master)
[![Total Downloads](https://poser.pugx.org/lastguest/pixeler/downloads.svg)](https://packagist.org/packages/lastguest/pixeler)
[![Latest Stable Version](https://poser.pugx.org/lastguest/pixeler/v/stable.svg)](https://packagist.org/packages/lastguest/pixeler)
[![Latest Unstable Version](https://poser.pugx.org/lastguest/pixeler/v/unstable.svg)](https://packagist.org/packages/lastguest/pixeler)
[![License](https://poser.pugx.org/lastguest/pixeler/license.svg)](https://packagist.org/packages/lastguest/pixeler)


```
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
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

Create a file `pixeler.php` :

```php
<?php
// Vendors
include __DIR__."/vendor/autoload.php";

// Resize factor 1.0 = 100%
$resize = (isset($argv[2]) ? $argv[2] * 1.0 : 1.0);

// If true invert the image colors
$invert = (isset($argv[3]) ? $argv[3] == '-i' : false);

// The PixelerImage instance render itself if casted to a string
echo Pixeler::image($argv[1], $resize, $invert);

```

```
$ php pixeler.php lastguest.png 0.25 -i
```
