<?php
	/*																																																	*
	 * Cannot change directory exception handler.																												*
	 *																																																	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/

	class FTPMCannotChangeDirException extends FtpManagerException {
		/**
		 * FTPMCannotChangeDirException class for change directory exceptions handling.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Exception code.
		 *
		 * @var int
		 */
		protected $code = 6007;
		
		/**
		 * Exception message.
		 *
		 * @var string
		 */
		protected $message = 'Cannot change directory to: ';
		
		/**
		 * FTPMCannotChangeDirException contructor.
		 *
		 * @access public
		 * @param string $dirpath The path to the destination directory.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($dirpath) {
			parent::__construct($this->message.$dirpath, $this->code, __CLASS__);
		}
	}
	