<?php
	/*																																																	*
	 * Cannot deconnect server exception handler.																												*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

	class FTPMDeconnectException extends FtpManagerException {
		/**
		 * FTPMDeconnectException class for server deconnection exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6008;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'An error occured during FTP deconnexion process';
		
		/**
		 * FTPMDeconnectException contructor.
		 *
		 * @access public
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct() {
			parent::__construct($this->message, $this->code, __CLASS__);
		}
	}
	