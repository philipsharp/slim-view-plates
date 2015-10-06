# Custom Slim Framework view for the Plates

This library provides a custom view for the [Slim Framework](http://www.slimframework.com/)
to support the [Plates](http://platesphp.com/) template engine.

## Usage

Add the provider to your `composer.json` file:

```json
{
    "require": {
        "philipsharp/slim-view-plates": "5.*"
    }
}
```

Enable it in your application

```php
<?php

$view = new \philipsharp\Slim\View\Plates();

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

### Advanced Usage

To access the Plates engine object for further customization, including loading
extensions, call `$view->getInstance()`.
