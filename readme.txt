=== Uploader ===
Contributors: robertabramski
Donate link: http://raurl.com/9w
Tags: upload, files, uploadify
Requires at least: 2.8
Tested up to: 3.4.1
Stable tag: 1.0.4

Uploader creates an Uploader role for file uploading.

== Description ==

Uploader creates an Uploader role (a Subscriber role with an extra <code>uploader_upload</code> capability) for file uploading within wp-admin after credentials have been input in wp-login.php. This plugin is based on the <a href="http://www.uploadify.com">Uploadify</a> project.

== Installation ==

1. Upload `uploader` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Why would I need this? =

Perhaps you have someone that you want to be able to get files from but you don't want to give them FTP access to your site or maybe they might not even know how to use FTP even if you gave it to them. This is what this is intended to fix.

= Why is a user account needed? =

This keeps it so that not just anybody can upload (possibly malicious) files to your blog. An admin has to take the time to change the account from Subscriber to Uploader. This is more secure. To make it more secure you can remove certain file extensions in the settings.

= My files didn't show up. Why not? =

Make sure that wp-content/uploads directory is writable.

== Screenshots ==

1. The upload interface, ready for file selection.
2. The queue has been filled and is ready for an upload.
3. Settings page allows the user to change some of the behaviors of the uploader.

== Changelog ==

= 1.0.4 =
* Fixed jQuery bug.

= 1.0.3 =
* Addressed security holes.

= 1.0.2 =
* Addressed security holes in the Uploadify server side script.

= 1.0.1 =
* Added donate link. Gotta get paid.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
No updates are needed yet.