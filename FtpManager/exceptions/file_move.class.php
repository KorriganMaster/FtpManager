<?php
	/*																																																	*
	 * Cannot set FTP mode exception handler.																														*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
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
