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
"php": ">=7.0.0",
"nette/nette": ">=2.4.0",
"geniv/nette-general-form": ">=1.0.0"
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

protected function createComponentBreadCrumb(BreadCrumb $breadCrumb): BreadCrumb
{
    // $breadcrumb->setTemplatePath(__DIR__ . '/templates/BreadCrumb.latte');
    // $breadcrumb->addLink('link', ['Homepage:'], 'icon-homepage');  // default breadcrumb
    return $breadcrumb;
}
```

presenters:
```php
// add link
$this['breadCrumb']->addLink('Sub page');
// or
$this['breadCrumb']->addLink('Sub page', ['User:'])
// link with parameters
$this['breadCrumb']->addLink('Sub page', ['User:', 123, 321])
or
$this['breadCrumb']->addLink('Sub page', ['User:', 123, 321], 'fa fa-dashboard')

direct transalte title
$this['breadCrumb']->addTranslateLink('Sub page');
```
or update
```php
// edit link
$this['breadCrumb']->editLink('Sub page', ['User:'], 'fa fa-dashboard')
// link with parameters
$this['breadCrumb']->editLink('Sub page', ['User:', 123, 321], 'fa fa-dashboard')
direct transalte title
$this['breadCrumb']->editTranslateLink('Sub page');
```
or remove
```php
// remove
$this['breadCrumb']->removeLink('Sub page');
```

usage:
```latte
{control breadCrumb}
```
