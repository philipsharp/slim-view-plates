# Custom Slim Framework view for the Plates

This library provides a custom view for the [Slim Framework](http://www.slimframework.com/)
to support the [Plates](http://platesphp.com/) template engine.

## Usage

Add the provider to your `composer.json` file:

```json
{
    "require": {
        "philipsharp/slim-view-plates": "2.*"
    }
}
```

Enable it in your application

```php
<?php

$view = new \PhilipSharp\Slim\View\Plates();

$app = new \Slim\Slim(array(
    'view' => $view
));
```

## Configuration

### Template File Extension

Set `$view->fileExtension` to the file extension used for all templates.

By default Plates expects the extension to be `.php`.

### Templates Path

Set `$view->templatesPath` to the location of the templates.

By default Slim-View-Plates will use the Slim templates.path configuration
value. This setting allows you to override that value for only the Plates
templates.

### Templates Folder

Add to the `$view->templatesFolders` array, where the key is the name of the
folder and the value is the path.

### Extension

You can access Slim's URL functions inside templates by hooking up the view 
extension: 

```php
$view->parserExtensions = array(
    new \PhilipSharp\Slim\View\PlatesExtension()
);
```

#### URL

Inside your Plates template you would write:

    <?= $this->urlFor('hello', array('name' => 'Josh', 'age' => '19')); ?>

You can easily pass variables that are objects or arrays by doing:

    <a href="<?= $this->slim()->urlFor('hello', array('name' => $person->name, 'age' => $person->age)) ?>">Hello <?= $name; ?></a>

If you need to specify the appname for the getInstance method in the urlFor functions, set it as the third parameter of the function
in your template:

    <a href="<?= $this->slim()->urlFor('hello', array('name' => $person->name, 'age' => $person->age), 'admin') ?>">Hello <?= $name; ?></a>

#### Site URL

Inside your Plates template you would write:

    <?= $this->slim()->siteUrl('/about/me'); ?>

#### Base URL

Inside your Plates template you would write:

    <?= $this->slim()->baseUrl(); ?>

#### Slim Instance

Inside your plates template you would write: 
    
    <? $this->slim()->getInstance('appname'); ?>

### Advanced Usage

To access the Plates engine object for further customization, including loading
extensions, call `$view->getInstance()`.
