Nette Breadcrumb
===========================================

Simple [Nette](http://nette.org) component creating Breadcrumb navigation.


Installation
------------
The best way to install this component is throught [Composer](http://getcomposer.org/).

```sh
$ composer require geniv/nette-breadcrumb
```

composer.json:
```json
"geniv/nette-breadcrumb": ">=1.0",
```

Using
-----
Create component in your presenter (idelly in BasePresenter) and add link to the main page -

```neon
- BreadCrumb
```

```php
use BreadCrumb;

protected function createComponentBreadCrumb()
{
    $breadCrumb = new BreadCrumb();
    $breadCrumb->addLink('Main page', 'Homepage:', 'icon-homepage');

    return $breadCrumb;
}
```

or use with Autowire (eg. geniv/nette-autowired)

```php
use AutowireComponentFactories;
use BreadCrumb;

public function createComponentBreadCrumb(BreadCrumb $breadcrumb)
{
    $breadCrumb->setTemplatePath(__DIR__ . '/templates/breadcrumbs.latte');
    $breadcrumb->addLink('link', 'Homepage:', 'icon-homepage');
    return $breadcrumb;
}
```

In another presenter, when we want to add another link -

```php
$this['breadCrumb']->addLink('Sub page')
```
to edit this link on any presenter's action you could use the next

```php
// only link
$this['breadCrumb']->editLink('Sub page', 'User:', 'fa fa-dashboard')
// link with parameters
$this['breadCrumb']->editLink('Sub page', ['User:', 123, 321], 'fa fa-dashboard')
```

and to remove
```php
$this['breadCrumb']->removeLink('Sub page')
```


Calling it from templates

```latte
{control breadCrumb}
```
finally if you have your own template you can call with setTemplatePath($template) on the presenter class, by example

```php
// on your component declaration (maybe called BasePresenter.php) 
$breadCrumb->setTemplatePath(__DIR__.'/templates/@BreadCrumb.latte');

// or on your regular presenter
$this['breadCrumb']->setTemplatePath(__DIR__.'/templates/@BreadCrumb.latte');
```
