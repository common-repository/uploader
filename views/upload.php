<div id="icon-tools" class="icon32"><br /></div>
<div class="wrap">
	<h2>Uploader</h2>
	<noscript>
		<div id="message" class="updated fade">
			<p><strong>Enable JavaScript to use the uploader.</strong></p>
		</div>
		<style>#uploader { display:none; }</style>
	</noscript>
	<div id="uploader">
		<div id="message" class="updated fade hidden"></div>
		<div id="uploadbar">
			<button class="button upload" onclick="checkQueue(this)">Start Upload</button>
			<button class="button clear" onclick="checkQueue(this)">Clear Queue</button>
		</div>
		<div id="itemqueue"></div>
		<input id="fileload" name="fileload" type="file" />
		<script type="text/javascript">
		
			var exts = '<?php echo($exts);?>';
			jQuery('#itemqueue').attr('title', 'Valid file types are: ' + exts.split(';').join(', ')+'.');
			
			jQuery(document).ready(function()
			{
				jQuery('#fileload').uploadify
				({
					'auto':false, 'multi':true,
					'removeCompleted':false,
					'uploader':'<?php echo($uploadify_path);?>uploadify.swf',
					'script':'<?php echo($uploadify_path);?>uploadify.php',
					'cancelImg':'<?php echo($uploadify_path);?>cancel.png',
					'folder':'<?php echo($folder);?>',
					'queueID':'itemqueue',
					'fileExt':'<?php echo($exts);?>',
					'fileDesc':'Acceptable Files',
					
					'onSelectOnce':function(event, data)
					{
						var num = data.fileCount;
						
						message = num + ' file' + (num == 1 ? ' is' : 's are') + ' in queue.';
						showMessage(message);
					},
					
					'onCancel':function(event, ID, fileObj, data)
					{
						jQuery('#fileload' + ID).remove();
						
						message = 'The file "' + fileObj.name + '" has been removed from the queue.';
						showMessage(message);
					},
					
					'onClearQueue':function(event)
					{
						var message = 'The queue has been cleared.';
						showMessage(message);
						
						jQuery('.itemwrap').remove();
					},
					
					'onComplete':function(event, ID, fileObj, response, data)
					{
						var i = '#fileload' + ID;
						var message = 'The file "' + fileObj.name + '" has been removed from the queue.';
						var js = "javascript:jQuery('"+i+"').remove(); showMessage('"+message+"');";
						
						jQuery(i + ' .cancel a').attr('href', js);
						
						showMessage(response);
					},
					
					'onAllComplete':function(event, data)
					{
						if(data.errors == 0)
						{				
							jQuery.ajax
							({
								'type':'GET',
								'url':'<?php echo($uploader_path);?>views/notify.php',
								
								'data':
								{	
									'notify':'<?php echo($notified);?>', 
									'num':data.filesUploaded, 
									'blog':'<?php echo($blogname);?>',
									'email':'<?php echo($email);?>',
									'name':'<?php echo($display_name);?>',
									'folder':'<?php echo($folder);?>'
								},
								
								'success':function(data)
								{	
									showMessage(data);
								},
								
								'error':function(xhr, textStatus, errorThrown)
								{
									message  = 'The uploads have completed but there was ';
									message += 'an error sending notification.';
									showMessage(message);
								}
							});
						}
						else
						{
							num = data.errors;
							message = 'There ' (num == 1 ? 'was '+num+' error' : 'were '+num+'errors') + ' with the upload.';
							showMessage(message);
						}
						
						return false;
					}
				});
			});
			
			function showMessage(message)
			{
				jQuery('#message').removeClass('hidden');
				jQuery('#message').html('<p><strong>' + message + '</strong></p>');
			}
			
			function checkQueue(button)
			{
				var queueEmpty = (jQuery('.uploadifyQueueItem').length == 0);
				var num = jQuery('.uploadifyQueueItem').length;
				var message;
				
				if(jQuery(button).hasClass('upload'))
				{
					jQuery('#fileload').uploadifyUpload();
					if(queueEmpty) message = 'Select files to add items to the queue.';
					else return;
				}
				else if(jQuery(button).hasClass('clear')) 
				{
					jQuery('#fileload').uploadifyClearQueue();
					
					if(queueEmpty) message = 'No there are no items to clear.';
					else message = 'Queue has been cleared of '+num+' file' + (num == 1 ? '':'s') + '.';
				}
				
				showMessage(message);
			}
			
		</script>
	</div>	
</div>