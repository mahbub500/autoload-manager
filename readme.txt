=== Options Autoload Manager ===
Contributors: @mahbubmr500
Tags: optimize-database, autoloader
Requires at least: 5.0 or higher
Tested up to: 6.6.2
Requires PHP: 7.0 or higher
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==
The Auto Load Manager plugin allows WordPress site administrators to easily control the autoload setting of options stored in the database. Autoloaded options can significantly impact website performance, especially on larger sites, by loading certain data on every page request. With this plugin, users can toggle the autoload status for individual options, optimizing performance without requiring direct database access.

The plugin provides an intuitive interface, allowing users to search for specific options and manage their autoload settings with a single click. This feature is ideal for improving site speed by reducing unnecessary data loading, making it accessible to both novice and advanced users.

Whether you are a developer fine-tuning a site or a beginner looking to enhance performance, Auto Load Manager gives you the control you need to optimize autoload behavior and boost overall site efficiency.

== Installation ==

Upload the plugin files to the /wp-content/plugins/options-autoload-manager directory or install the plugin through the WordPress plugins screen directly.
Activate the plugin through the 'Plugins' screen in WordPress.
Navigate to Tools > Options Autoload Manager to start managing autoload settings.
== Frequently Asked Questions ==

Q: What does "autoload" mean in WordPress options?
A: Autoloaded options are loaded into memory on every page load. Disabling autoload for unnecessary options can improve performance, especially on sites with a large number of autoloaded options.

Q: Can I break my site by changing autoload settings?
A: It's possible to affect site functionality if critical options are not autoloaded. Use caution and ensure you know the purpose of each option before making changes.

== Changelog ==

1.0.0

Initial release of the Options Autoload Manager plugin.