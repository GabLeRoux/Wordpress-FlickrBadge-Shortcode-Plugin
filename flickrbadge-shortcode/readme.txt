=== Plugin Options Starter Kit ===
Contributors: dgwyer
Tags: Plugin, options, starter, kit, admin, blog, sanitize, api
Requires at least: 3.3
Tested up to: 3.3
Stable tag: 0.2

Starter kit to help create Plugin options pages, and learn how to put it all together. Contains all the commonly used form options.

== Description ==

*Update* Now includes examples of how to easily use the WordPress editor multiple times on your Plugin options pages! This is implemented via the new re-usable WordPress editor feature in WordPress 3.3.

Simple way to learn and set-up your Plugin options pages very quickly!

Use it to learn how to set-up Plugin options, or as a template to quickly create you own Plugins. There are lot's of code comments and sample usage of the Plugin options on the front end of your site.

Learn the proper way to use the powerful WordPress Settings API, and how to save all your Plugin options in a single options db entry (in an array). This is the recommended way to store your Plugin options as it cleaner and more efficient.

*The starter kit also includes*

* A useful 'Settings' link from the main Plugins page so that you can easily direct your Plugin users directly to your Plugin options page.
* A way to set-up default option settings when the Plugin is activated.
* A reset defaults Plugin option which you can use on all your Plugins which allows you to reset options opon Plugin deactivation/reactivation.
* A clean way to delete Plugin options if the Plugin is deactivated AND deleted.
* Uses sanitization methods (part of the Settings API) to cleanly validate textbox and textarea inputs.

All the starter kit code is properly indented to make it easier to read and follow the Plugin structure.

*Coming Soon*

Let me know if you have any suggestions to add to the list (or other starter kits you would love to see).

* Add developer version (without all the comments etc.) to create new Plugins from scratch even quicker!
* Examples of adding options to other WordPress admin pages too.
* Add Plugin localization.
* Extend the default settings callback function so that is allows for Plugin default options to be correctly set if they were added after the Plugin was FIRST activated.

Please rate the Plugin Options Starter Kit if you find it useful, thanks.

See our <a href="http://www.presscoders.com" target="_blank">WordPress development site</a> for more information, or our <a href="http://wordpress.org/extend/plugins/profile/dgwyer" target="_blank">other WordPress Plugins</a>.

== Installation ==

The Plugin can be installed directly from the main WordPress Plugin page.

1. Go to the Plugins => Add New page.
2. Enter 'Plugin Options Starter Kit' (without quotes) in the textbox and click the 'Search Plugins' button.
3. In the list of relevant Plugins click the 'Install' link for Plugin Options Starter Kit on the right hand side of the page.
4. Click the 'Install Now' button on the popup page.
5. Click 'Activate Plugin' to finish installation.
6. That's it!

== Screenshots ==

1. Plugin options screen.
2. Example of using/testing a Plugin option from the site front end.

== Changelog ==

*0.2*

* Added two more text area controls that use the built-in WordPress editor to render content.
* Added a feature that demonstrates how to require a specific version of WordPress (or higher) before the Plugin will run. If the current version of WordPress is not compatible then the Plugin automatically deactivates itself.

*0.17*

* Fixed incorrect image paths.

*0.16*

* Added the escape_html() function around the default textarea text to escape the content properly.
* Tested on WordPress 3.2.1.

*0.15*

* Screenshots added!

*0.1 Initial Release*