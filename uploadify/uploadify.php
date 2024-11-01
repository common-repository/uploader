<?php

	if(!empty($_FILES))
	{
		$temp_file = $_FILES['Filedata']['tmp_name'];
		$target_path = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] .'/';
		
		$dir = str_replace('//', '/', $target_path);
		if(!file_exists($dir)) mkdir($dir, 0755, true);
		$target_path = realpath($target_path);
		
		//Not a good path to upload to.
		if(!$target_path) { header("HTTP/1.1 500 Internal Server Error"); exit(); }
		else $target_file = str_replace('//', '/', $target_path) . '/' . $_FILES['Filedata']['name'];
			
		if(strpos($target_path, '/wp-content/uploads') !== false)
		{
			$file_types  = str_replace('*.', '', $_REQUEST['fileext']);
			$file_types  = str_replace(';', '|', $file_types);
			$types_array = explode('|', $file_types);
			$file_parts  = pathinfo($_FILES['Filedata']['name']);
			$file_name   = $file_parts['filename'] . '.' . $file_parts['extension'];
			
			if(in_array($file_parts['extension'], $types_array))
			{
				move_uploaded_file($temp_file, $target_file);
				echo 'The file "' . $file_name . '" has been uploaded.';
			}
			else
			{
				//The file is an invalid file type.
				header("HTTP/1.1 500 Internal Server Error"); exit();
			}
		}
		else
		{
			//Invalid path. The path must be inside the /wp-content/uploads directory.
			header("HTTP/1.1 500 Internal Server Error"); exit();
		}
	}
	
?>