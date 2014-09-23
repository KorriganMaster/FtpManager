<?php
	/*																																																	*
	 * This file loads all exception classes from the exceptions directory															*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

	define('EXCEPTIONS_DIR', dirname(__FILE__).DS.'exceptions');

	$files_list = array_diff(scandir(EXCEPTIONS_DIR), array('.', '..'));

	foreach($files_list as $exception_file) {
		require_once(EXCEPTIONS_DIR.DS.$exception_file);
	}
	