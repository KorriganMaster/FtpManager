<?php
	/*																																																	*
	 * Cannot connect to server exception handler.																											*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/
	
	class FTPMConnectException extends FtpManagerException {
		/**
		 * FTPMConnectException class for server connection exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6003;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'Cannot connect to server : ';
		
		/**
		 * FTPMConnectException contructor.
		 *
		 * @access public
		 * @param string $server The server address you're trying to connect with.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($server) {
			parent::__construct($this->message.$server, $this->code, __CLASS__);
		}
	}
	