# validator
A validator that works

## Why?
Breifly, a PHP validator that is:
1. Standalone
2. Works independenltly for data, as well as files.
3. Flexible.

## How it works?
### Simple value simple check
```php
if($errors = ItvisionSy\Validator\RequiredValidatorRule::quick('99')===true){
  // validator succeeded
} else {
  // failed
  var_dump($errors);
}
```
### Simple valude multiple checks
```php
if($errors = ItvisionSy\Validator\ValidatorItem::quick(99,'required')===true){
  // succeeded
} else {
  // failed
  var_dump($errors);
}
```
### Data validation
```php
if($errors = ItvisionSy\Validator\Validator::quick([
  'name'=>'required|string|min:4',
  'email'=>'required|email'
],[
  'name'=>'Muhannad Shelleh'
])===true){
  // succeeded
} else {
  // failed (like now)
  var_dump($errors);
}
```
