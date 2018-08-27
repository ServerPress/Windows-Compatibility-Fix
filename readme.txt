=== Windows Compatibility Fix ===
Contributors: serverpress, spectromtech, davejesch, Steveorevo
Donate link: http://serverpress.com
Tags: windows, upgrade, update, plugin, theme, long filename, create, directory, error, desktopserver, edd
Requires at least: 4.0
Tested up to: 4.9
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Fixes long filename problem on Windows systems when doing updates, such as updating from EDD based sites.

== Description ==

This plugin will fix long filename problems on Windows systems when doing updates from third-party plugin repositories, such as updating from EDD based sites.

<strong>Usage Scenarios:</strong>

We've found that users on Windows systems that are upgrading themes and plugins from a third-party repository, such as an Easy Digital Downloads (EDD) site have problems. They will see an error message of "Update Failed: Could not create directory...". The reason for this is that during the update process, the file name requested from the EDD site has the product name, user name and other information encoded within it so that EDD knows who is requesting the file. This results in a very long file name. This is not necessarily a problem WordPress itself, or even EDD, as this works on non-Windows systems. But if you are running WordPress on Windows and see this error, it is because of the long file name requested.

If you are using DesktopServer for your local development on Windows and would like to use the Windows Compatibility Fix plugin as a Design Time plugin, you can install this in your C:\xampplite\ds-plugings directory and it can then be automatically activated and used with all of your local development web sites. This allows you to use the plugin in your local environment, where it's needed and not to deploy it to your live environment where it may not be needed. For more information on DesktopServer and local development tools, please visit our web site at: https://serverpress.com/get-desktopserver/

Because this fix is only needed on Windows systems, the plugin checks the operating system on which it is running and does not initialize itself. If you are having problems with the update process on non-Windows systems, it is more likely an issue with directory permissions.

<strong>How it Works:</strong>

The Windows Compatibility Fix plugin uses a couple of WordPress filters employed during the update process. It modifies the name of the file that is downloaded to your system, shortening it to just a few characters. This allows WordPress's update process to work correctly on Windows systems by not creating the long file name in the first place.

<strong>Support:</strong>

><strong>Support Details:</strong> We are happy to provide support and help troubleshoot issues. Visit our Contact page at <a href="http://serverpress.com/contact/">http://serverpress.com/contact/</a>. Users should know however, that we check the WordPress.org support forums once a week on Wednesdays from 6pm to 8pm PST (UTC -8).

ServerPress, LLC is not responsible for any loss of data that may occur as a result of using this tool. We strongly recommend performing a site and database backup before testing and using this tool. However, should you experience such an issue, we want to know about it right away.

We welcome feedback and Pull Requests for this plugin via our public GitHub repository located at: <a href="https://github.com/ServerPress/Windows-Compatibility-Fix">https://github.com/ServerPress/Windows-Compatibility-Fix</a>

== Installation ==

Installation instructions: To install, do the following:

1. From the dashboard of your site, navigate to Plugins --&gt; Add New.
2. Select the "Upload Plugin" button.
3. Click on the "Choose File" button to upload your file.
3. When the Open dialog appears select the windows-compatability-fix.zip file from your desktop.
4. Follow the on-screen instructions and wait until the upload is complete.
5. When finished, activate the plugin via the prompt. A confirmation message will be displayed.

or, you can upload the files directly to your server.

1. Upload all of the files in `Windows-Compatibility-Fix.zip` to your  `/wp-content/plugins/windows-compatability-fix` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Screenshots ==

1. Plugin page.

== Changelog ==
= 1.0.2 - Aug 27, 2018 =
* Make this a DesktopServer Must-Use plugin

= 1.0.1 - Jan 22, 2017 =
* Fix typo in plugin name in readme (Thanks Dave C.)

= 1.0.0 - May 3, 2017 =
* Initial release to WordPress repository.

= 1.0.0 - Mar 29, 2017 =
* Initial Release

== Upgrade Notice ==

= 1.0.0 =
First release.
