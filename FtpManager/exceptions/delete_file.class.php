<?php
	/*																																																	*
	 * Cannot delete file exception handler.																														*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

 	class FTPMDeleteFileException extends FtpManagerException {
		/**
		 * FTPMDeleteFileException class for file delete exceptions handling.
		 *
		 * @version 1.0
		 */
	
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6002;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'file cannot been removed.';
		
		/**
		 * FTPMDeleteFileException contructor.
		 *
		 * @access public
		 * @param string $filepath The path to the file you're trying to delete.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($filepath) {
			parent::__construct($filepath.' '.$this->message, $this->code, __CLASS__);
		}
	}
	