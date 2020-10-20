# wp-confetti-js
WP Shortcode Plugin that uses confetti-js 

## Basic use..
Paste this shortcode into your WP page editor. (classic editor, TinyMCE WYSIWYG)
```
[confetti]
```

## Advance use...

```php
// default arguments can be overriden
'popupDelay'=>'1000',
'shapes'=> 'circle,square,triangle,line',
'colors' => '244, 228, 164|239, 214, 118|234, 201, 72|228, 187, 27|189, 155, 22|137, 112, 16|91, 75, 11',
'svg'=> '',
'max'=> 100,
'size'=> 2,
'animate'=> true,
'clock' => 25,
'respawn'=> true,
'rotate'=> true,
'modal'=> 'true'

```

```shell
[confetti modal='false']
//...Add content to use in front of confetti...
[/confetti]
```
