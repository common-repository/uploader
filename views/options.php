<div class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2>Uploader Settings</h2>
	<form method="post" action="options.php">
	<?php settings_fields('uploader_settings'); ?>
		
	    <table class="form-table">
	        <tr valign="top">
		        <th scope="row">Upload Location</th>
		        <td>
		        	<input type="checkbox" name="uploader_usebase" <?php echo($fn->chbox($usebase));?> />
		        	<label> Use base folder for uploads</label>
		        	<br />
		        	<label>Folder Name </label>
		        	<input type="text" name="uploader_basedir" value="<?php echo($basedir);?>" />
		        </td>
	        </tr>
	        <tr valign="top">
		        <th scope="row">Notification</th>
		        <td>
		        	<input type="checkbox" name="uploader_notif" <?php echo($fn->chbox($notif));?> />
		        	<label> Send email when files are uploaded</label>
		        </td>
	        </tr>
	        <tr valign="top">
		        <th scope="row">File Types Allowed</th>
		        <td>
		        	<textarea cols="40" rows="5" name="uploader_exts"><?php echo($exts);?></textarea>
		        </td>
	        </tr>
	    </table>
	    
	    <p class="submit">
	    	<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
	    </p>
	    
	</form>
</div>