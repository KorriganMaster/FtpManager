<?php
	/*																																																	*
	 * Cannot move file exception handler.																															*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-23																																			*
	 *																																																	*/
	
	class FTPMCannotMoveFileException extends FtpManagerException {
		/**
		 * FTPMCannotMoveFileException class for file move exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6012;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = "Cannot move file from '%frompath%' to '%topath%'";
		
		/**
		 * FTPMCannotMoveFileException contructor.
		 *
		 * @access public
		 * @param string $frompath 	The path to the original file.
		 * @param string $topath 		The destination path wher you want to move the file.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($frompath, $topath) {
			foreach(array('frompath', 'topath') as $info) {
				$this->message = str_replace('%'.$info.'%', ${$info}, $this->message);
			}
			parent::__construct($this->message.$server, $this->code, __CLASS__);
		}
	}
