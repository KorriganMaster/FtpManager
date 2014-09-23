<?php
	/*																																																	*
	 * Cannot login to the server exception handler.																										*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

	class FTPMLoginException extends FtpManagerException {
		/**
		 * FTPMLoginException class for login to server exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6004;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = "Cannot login to server : '%server%' with the following identifiers : login: '%login%' and password: '%password%'";
		
		/**
		 * FTPMLoginException contructor.
		 *
		 * @access public
		 * @param string $server		Server address you're trying to log in.
		 * @param string $login			Login used for the connection.
		 * @param string $password	Password used for the connection.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($server, $login, $password) {
			foreach(array('server', 'login', 'password') as $info) {
				$this->message = str_replace('%'.$info.'%', ${$info}, $this->message);
			}
			parent::__construct($this->message, $this->code, __CLASS__);
		}
	}
	