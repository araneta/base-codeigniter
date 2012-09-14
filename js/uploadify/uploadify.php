<?php
/*
Uploadify v2.1.4
Release Date: November 8, 2010

Copyright (c) 2010 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

/*
*	Functions taken from CI_Upload Class
*
*/
	
	function set_filename($path, $filename, $file_ext, $encrypt_name = FALSE)
	{
		if ($encrypt_name == TRUE)
		{		
			mt_srand();
			$filename = md5(uniqid(mt_rand())).$file_ext;	
		}
	
		if ( ! file_exists($path.$filename))
		{
			return $filename;
		}
	
		$filename = str_replace($file_ext, '', $filename);
		
		$new_filename = '';
		for ($i = 1; $i < 100; $i++)
		{			
			if ( ! file_exists($path.$filename.$i.$file_ext))
			{
				$new_filename = $filename.$i.$file_ext;
				break;
			}
		}

		if ($new_filename == '')
		{
			return FALSE;
		}
		else
		{
			return $new_filename;
		}
	}
	
	function prep_filename($filename) {
	   if (strpos($filename, '.') === FALSE) {
		  return $filename;
	   }
	   $parts = explode('.', $filename);
	   $ext = array_pop($parts);
	   $filename    = array_shift($parts);
	   foreach ($parts as $part) {
		  $filename .= '.'.$part;
	   }
	   $filename .= '.'.$ext;
	   return $filename;
	}
	
	function get_extension($filename) {
	   $x = explode('.', $filename);
	   return '.'.end($x);
	} 

if (!empty($_FILES)) {
	$path = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
   //$client_id = $_GET['client_id'];
   $file_temp = $_FILES['Filedata']['tmp_name'];
   $file_name = prep_filename($_FILES['Filedata']['name']);
   $file_ext = get_extension($_FILES['Filedata']['name']);
   $real_name = $file_name;
   $newf_name = set_filename($path, $file_name, $file_ext);
   $file_size = round($_FILES['Filedata']['size']/1024, 2);
   $file_type = preg_replace("/^(.+?);.*$/", "\\1", $_FILES['Filedata']['type']);
   $file_type = strtolower($file_type);
   $targetFile =  str_replace('//','/',$path) . $newf_name;
   move_uploaded_file($file_temp,$targetFile);

   $filearray = array();
   $filearray['file_name'] = $newf_name;
   $filearray['real_name'] = $real_name;
   $filearray['file_ext'] = $file_ext;
   $filearray['file_size'] = $file_size;
   $filearray['file_path'] = $targetFile;
   $filearray['file_temp'] = $file_temp;
   //$filearray['client_id'] = $client_id;

   $json_array = json_encode($filearray);
   echo $json_array;
}else{
	echo "1";	
}
