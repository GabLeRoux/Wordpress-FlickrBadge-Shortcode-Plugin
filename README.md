Wordpress FlickrBadge Shortcode Plugin
======================================

This plugin will let you add a flickrbadge (List of Flickr pictures) into a post or a page, or even in a theme

Usage
-----
In a wordpress post or page
```php
[flickrbadge]
```
If you wish to hardcode the shortcode in a theme
```php
do_shortcode([flickrbadge])
```

Parameters
----------
- ```count```: Number of pictures to show.
  - Possible values: (whole integer) ```1``` to ```10```. 
- ```display```: The order the pictures are shown.
  - Possible values: (string) ```latest```, ```random```. Default: ```latest```.
  - Default: ```latest```
- ```layout```: The way the pictures are listed.
  - Possible values: (string)```h``` for horizontal, ```v``` for vertical, ```x``` for not styled.
  - Default: ```h``` for horizontal.
- ```source```:
  - Possible values: (string) ```user```, ```user_tag```, ```user_set```, ```group```, ```group_tag```, ```all```, ```all_tag```
- ```tag```: (Optional) Id of tag used with source ```user_tag```, ```group_tag``` and ```all_tag```.
  - Possible values: (string).
- ```group```: (Optional) Id of groupe used with source ```group``` and ```group_tag```.
  - Possible values: (integer) can be found at [idgettr](http://www.idgettr.com).
- ```set```: (Optional) Used with source ```user_set```.
  - Possible values: (integer) found in the url of the desired set (ex: …/sets/123456/ would be 123456)
- ```size```: Size of pictures.
  - Possible values: (string) ```s``` for square, ```t``` for thumbnail, and ```m``` for medium.
  - Default: ```t``` for thumbnail.

Example
-------
```php
[flickrbadge count="6" layout="h" display="latest" size="m" source="all_tag" tag="cat"]
```
Will display 6 latest cat medium sized pictures horizontally, meow! :P

TODO
----
- Fix Wordpress config page
- Find a way to display more than 10 pictures
- Enable lightbox or someting like that to display pictures in a cool way on click

license
-------
Use it the way you want
> 2012 Gabriel Le Breton