mod-wishlist
===========
Module for CORNER CMS

[![Latest Stable Version](https://poser.pugx.org/panix/mod-wishlist/v/stable)](https://packagist.org/packages/panix/mod-wishlist) [![Total Downloads](https://poser.pugx.org/panix/mod-wishlist/downloads)](https://packagist.org/packages/panix/mod-wishlist) [![Monthly Downloads](https://poser.pugx.org/panix/mod-wishlist/d/monthly)](https://packagist.org/packages/panix/mod-wishlist) [![Daily Downloads](https://poser.pugx.org/panix/mod-wishlist/d/daily)](https://packagist.org/packages/panix/mod-wishlist) [![Latest Unstable Version](https://poser.pugx.org/panix/mod-wishlist/v/unstable)](https://packagist.org/packages/panix/mod-wishlist) [![License](https://poser.pugx.org/panix/mod-wishlist/license)](https://packagist.org/packages/panix/mod-wishlist)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist panix/mod-wishlist "*"
```

or add

```
"panix/mod-wishlist": "*"
```

to the require section of your `composer.json` file.

Add to web config.
```
'modules' => [
    'wishlist' => ['class' => 'panix\wishlist\Module'],
],

