<?php
	/*																																																	*
	 * Cannot remove directory exception handler.																												*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

 	class FTPMRemoveDirException extends FtpManagerException {
		/**
		 * FTPMRemoveDirException class for remove directory exceptions handling.
		 *
		 * @version 1.0
		 */
	
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6001;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'directory cannot been removed.';
		
		/**
		 * FTPMRemoveDirException contructor.
		 *
		 * @access public
		 * @param string $dirpath The path to the directory you're trying to remove.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($dirpath) {
			parent::__construct($dirpath.' '.$this->message, $this->code, __CLASS__);
		}
	}
	