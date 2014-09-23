<?php
	/*																																																	*
	 * Cannot upload file on server exception handler.																									*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/
	
	class FTPMFilePutException extends FtpManagerException {
		/**
		 * FTPMFilePutException class for uploading file exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6010;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'An error occured when trying to upload the following file on the FTP server: ';
		
		/**
		 * FTPMFilePutException contructor.
		 *
		 * @access public
		 * @param string $filepath The local path to the file you're trying to upload on the server. 
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($filepath) {
			parent::__construct($this->message.$filepath, $this->code, __CLASS__);
		}
	}
	