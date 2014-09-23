<?php
	/*																																																	*
	 * Cannot get file from server exception handler.																										*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

	class FTPMFileGetException extends FtpManagerException {
		/**
		 * FTPMFileGetException class for getting a server's file exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6011;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'An error occured when trying to get the following file on the FTP server: ';
		
		/**
		 * FTPMFileGetException contructor.
		 *
		 * @access public
		 * @param string $filepath The path to the file on server.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($filepath) {
			parent::__construct($this->message.$filepath, $this->code, __CLASS__);
		}
	}
	