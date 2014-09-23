<?php
	/*																																																	*
	 * This is the main exception class. All others exception classes extends this one.									*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

	require_once(dirname(__FILE__).DS.'exceptions.inc.php');

	class FtpManagerException extends Exception {
		/**
		 * FtpManagerException class for FTP Manager exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Contain the current exception classname.
		 *
		 * @var string
		 */
		private $_classname;
		
		/**
		 * FtpManagerException contructor.
		 * Contruct an FtpManagerException object and initialise it with the exception informations.
		 *
		 * @access public
		 * @param string 	$message 		The message to display for the exception.
		 * @param int		 	$code				The error code associated to the exception.
		 * @param string 	$classname 	The classname corresponding to the exception (i.e. the exception name).
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($message, $code, $classname) {
			$this->_classname = $classname;
			parent::__construct($message, $code);
		}
		
		/**
		 * Return the exception as a readable string message.
		 *
		 * @access public
		 * @return string
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __toString() {
			return $this->_classname.': ['.$this->code.']: '.$this->message;
		}
	}
	