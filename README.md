Breadcrumb
==========

Installation
------------

```sh
$ composer require geniv/nette-breadcrumb
```
or
```json
"geniv/nette-breadcrumb": ">=1.0.0"
```

require:
```json
"php": ">=5.6.0",
"nette/nette": ">=2.3.0"
```

Include in application
----------------------

neon configure:
```neon
services:
    - BreadCrumb
```

usage:
```php
use BreadCrumb;

protected function createComponentBreadCrumb()
{
    $breadCrumb = new BreadCrumb();
    // $breadCrumb->setTemplatePath(__DIR__ . '/templates/breadcrumbs.latte');
    $breadCrumb->addLink('Main page', 'Homepage:', 'icon-homepage');
    return $breadCrumb;
}
```
or use with Autowire (eg. geniv/nette-autowired)
```php
use BreadCrumb;

public function createComponentBreadCrumb(BreadCrumb $breadcrumb)
{
    $breadcrumb->setTemplatePath(__DIR__ . '/templates/breadcrumbs.latte');
    // $breadcrumb->addLink('link', 'Homepage:', 'icon-homepage');
    return $breadcrumb;
}
```

presenters:
```php
// add link
$this['breadCrumb']->addLink('Sub page');
```
or
```php
// edit link
$this['breadCrumb']->editLink('Sub page', 'User:', 'fa fa-dashboard')
// link with parameters
$this['breadCrumb']->editLink('Sub page', ['User:', 123, 321], 'fa fa-dashboard')
```
or
```php
// remove
$this['breadCrumb']->removeLink('Sub page');
```

latte:
```latte
{control breadCrumb}
```
