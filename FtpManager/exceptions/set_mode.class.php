<?php
	/*																																																	*
	 * Cannot set FTP mode exception handler.																														*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/
	
	class FTPMSetModeException extends FtpManagerException {
		/**
		 * FTPMSetModeException class for set FTP mode exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6005;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'Cannot set mode for server: ';
		
		/**
		 * FTPMSetModeException contructor.
		 *
		 * @access public
		 * @param string $server The server address on which you want to set the mode.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($server) {
			parent::__construct($this->message.$server, $this->code, __CLASS__);
		}
	}
	