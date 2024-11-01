<?php

/*****************************************************************************************************	

Copyright (C) 2012  Robert Abramski

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

------------------------------------------------------------------------------------------------------

Plugin Name: Uploader
Plugin URI: http://wordpress.org/extend/plugins/uploader
Author: Robert Abramski
Version: 1.0.4
Author URI: http://robertabramski.com

Description: Uploader creates an Uploader role (a Subscriber role with an extra <code>uploader_upload</code> capability) for blind file uploading within wp-admin after credentials have been input in wp-login.php. This plugin is based on the <a href="http://www.uploadify.com">Uploadify</a> project. Uploader options can be modified at the <a href="options-general.php?page=uploader">Settings</a> page.

*****************************************************************************************************/

	require_once('uploader.php');
	
	global $uploader;
	$uploader = new Uploader();

?>