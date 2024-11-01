<?php

	$notify = $_GET['notify'];
	$num = is_numeric($_GET['num']) ? $_GET['num'] : 'NaN';
	$blog = $_GET['blog'];
	$email = $_GET['email'];
	$name = $_GET['name'];
	$folder = $_GET['folder'];
	
	$subject = '['.$blog.'] '.$num.' File' . ($num > 1 ? 's' : '') . ' Uploaded';
	
	$body  = $name.' has uploaded '.$num.' file' .($num > 1 ? 's' : ''). '. ';
	$body .= 'The files can be found in '.$folder.' on your blog.';
	
	$output = $num . ' file' . ($num > 1 ? 's' : '') . ' uploaded. ';
	
	if($notify == 'notif') 
	{
		$mailed = mail($email, $subject, $body);
	
		if($mailed) $output .= $blog . ' has been notified.';
		else $output .= 'The notification has failed.';
	}
	elseif($notify == 'unnotif') $output .= 'No notification has been sent to ' . $blog . '.';
	
	echo $output;

?>