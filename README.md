Nette Breadcrumb
===========================================

Simple [Nette](http://nette.org) component creating Breadcrumb navigation.


Installation
------------

```sh
composer require ngatngay/nette-breadcrumb:dev-master
```

Using
-----
Create component in your presenter (idelly in BasePresenter) and add link to the main page

```php
protected function createComponentBreadCrumb()
{
	$breadCrumb = new \NgatNgay\NetteBreadCrumb\BreadCrumb();
	$breadCrumb->addLink('Main page', $this->link('Homepage:'));

	return $breadCrumb;
}
```

In another presenter, when we want to add another link -

```php
$this['breadCrumb']->addLink('Sub page')
```
to edit this link on any presenter's action you could use the next

```php
$this['breadCrumb']->editLink('Sub page', $this->link('User:'), fa fa-dashboard)
```

and to remove
```php
$this['breadCrumb']->removeLink('Sub page')
```


Calling it from templates

```php
{control breadCrumb}
```
finally if you have your own template you can call with customTemplate($template) on the presenter class, by example

```php
// on your component declaration (maybe called BasePresenter.php) 
$breadCrumb->customTemplate($this->context->getParameters()['appDir'].'/templates/@BreadCrumb.latte');

// or on your regular presenter
$this['breadCrumb']->customTemplate($this->context->getParameters()['appDir'].'/templates/@BreadCrumb.latte');
```
