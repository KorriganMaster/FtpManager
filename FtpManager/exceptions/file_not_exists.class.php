<?php
	/*																																																	*
	 * File or directory doesn't exists exception handler.																							*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

	class FTPMFileNotExistsException extends FtpManagerException {
		/**
		 * FTPMFileNotExistsException class for file or directory doesn't exists exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6009;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'File or directory \'%file%\' doesn\'t exists in: %path%';
		
		/**
		 * FTPMFileNotExistsException contructor.
		 *
		 * @access public
		 * @param string $file The filename or directory name that cannot be found.
		 * @param string $path The path to the file or directory that cannot be found.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($file, $path) {
			if(empty($path)) {
				$path = '/';
			}
			foreach(array('file', 'path') as $info) {
				$this->message = str_replace('%'.$info.'%', ${$info}, $this->message);
			}
			parent::__construct($this->message, $this->code, __CLASS__);
		}
	}
	