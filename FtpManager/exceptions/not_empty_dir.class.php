<?php
	/*																																																	*
	 * Not empty directory exception handler.																														*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

	class FTPMNotEmptyDirException extends FtpManagerException {
		/**
		 * FTPMNotEmptyDirException class for not empty directory exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6000;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'directory is not empty and cannot be removed.';
		
		/**
		 * FTPMNotEmptyDirException contructor.
		 *
		 * @access public
		 * @param string $dirpath The path to the destination directory.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($dirpath) {
			parent::__construct($dirpath.' '.$this->message, $this->code, __CLASS__);
		}
	}
	