mod-discounts
===========
Module for CORNER CMS

[![Latest Stable Version](https://poser.pugx.org/panix/mod-discounts/v/stable)](https://packagist.org/packages/panix/mod-discounts) [![Total Downloads](https://poser.pugx.org/panix/mod-discounts/downloads)](https://packagist.org/packages/panix/mod-discounts) [![Monthly Downloads](https://poser.pugx.org/panix/mod-discounts/d/monthly)](https://packagist.org/packages/panix/mod-discounts) [![Daily Downloads](https://poser.pugx.org/panix/mod-discounts/d/daily)](https://packagist.org/packages/panix/mod-discounts) [![Latest Unstable Version](https://poser.pugx.org/panix/mod-discounts/v/unstable)](https://packagist.org/packages/panix/mod-discounts) [![License](https://poser.pugx.org/panix/mod-discounts/license)](https://packagist.org/packages/panix/mod-discounts)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist panix/mod-discounts "*"
```

or add

```
"panix/mod-discounts": "*"
```

to the require section of your `composer.json` file.

Add to web config.
```
'modules' => [
    'discounts' => ['class' => 'panix\discounts\Module'],
],

