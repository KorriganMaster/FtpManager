<?php
	/*																																																	*
	 * Cannot list directory exception handler.																													*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

	class FTPMCannotListDirException extends FtpManagerException {
		/**
		 * FTPMCannotListDirException class for listing directory exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6006;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'Cannot list content of directory: ';
		
		/**
		 * FTPMCannotListDirException contructor.
		 *
		 * @access public
		 * @param string $dirpath The path to the directory to list.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($dirpath) {
			parent::__construct($this->message.$dirpath, $this->code, __CLASS__);
		}
	}
	