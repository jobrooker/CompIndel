function create_zip($files = array(),$destination = '',$overwrite = false) {
	
	if(file_exists($destination) && !$overwrite) { return false;}

		$valid_files = array();

		if(is_array($file)) {
	
			foreach($files as $file) {
		
				if(file_exists($file)) {
					
					$valid_files[] = $file;
				
				}
			}
		}

		
