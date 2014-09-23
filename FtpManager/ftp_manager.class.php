<?php
	/*																																																	*
	 * This component provide a simple class to manage FTP connections and operations.									*
	 *																																																	*
	 * This script include for now two classes. The FtpManager class and its Exception handling class.	*
	 * It is free software; you can redistribute it and/or modify it under															*
	 * the terms of the GNU Lesser General Public License, either version 3															*
	 * of the License, or (at your option) any later version.																						*
	 *																																																	*
	 * ADER Lionel, the 2014-09-19																																			*
	 *																																																	*/
	
	require_once(dirname(__FILE__).DS.'ftp_manager_exception.class.php');
	
	class FtpManager {
		/**
		 * FtpManager class for FTP operations management.
		 *
		 * @version 1.0
		 */
		
		/**
		 * Contain URL to connect the server
		 *
		 * @var string
		 */
		private $_server_url;
		
		/**
		 * User login for connection to FTP server
		 *
		 * @var string
		 */
		private $_login;
		
		/**
		 * User password for connection to FTP server
		 *
		 * @var string
		 */
		private $_password;
		
		/**
		 * FTP connection handler returned by ftp_connect function
		 *
		 * @var resource|boolean
		 */ 
		private $_handler;
		
		/**
		 * Port to use to connect to the FTP server
		 */
		private $_port = 21;
		
		/**
		 * Set the FTP connection to passive mode
		 *
		 * @var boolean
		 */
		private $_passive_mode;
		
		/**
		 * Public methods
		 */
		
		/**
		 * FtpManager contructor.
		 * Contruct an FtpManager object and initialise the connection to the server.
		 *
		 * @access public
		 * @param string 	$server_url The URL to connect the FTP server.
		 * @param string 	$login			User login to conenct the FTP server.
		 * @param string 	$password 	User password to connect the FTP server.
		 * @param boolean	$is_passive	Set the connection to passive.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __construct($server_url = '', $login = '', $password = '', $is_passive = true) {
			if(!empty($server_url) && !empty($login) && !empty($password)) {
				$this->__parseUrl($server_url);
				$this->_login = $login;
				$this->_password = $password;
				$this->_handler = @ftp_connect($this->_server_url, $this->_port);
				$this->_passive_mode = $is_passive;
				if($this->_handler === false) {
					throw new FTPMConnectException($server_url);
				}
				if(@ftp_login($this->_handler, $this->_login, $this->_password)) {
					if(!ftp_pasv($this->_handler, $this->_passive_mode)) {
						throw new FTPMSetModeException($server_url);
					}
				} else {
					throw new FTPMLoginException($server_url, $login, $password);
				}
			}
		}
		
		/**
		 * List files in a directory.
		 *
		 * @access public
		 * @param string $path Directory path where to list files.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function ls($path = '.') {
			$file_list = null;
			$file_list = ftp_nlist($this->_handler, $path);
			if($file_list === false) {
				throw new FTPMCannotListDirException($this->pwd().$path);
			} else {
				return $file_list;
			}
		}
		
		/**
		 * Create a new directory tree according to $dirpath on the FTP.
		 *
		 * @access public
		 * @param string $dirpath Name of the new directory.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function mkdir($dirpath) {
			$dirArray = null;
			$curDir = $this->pwd();
			if(empty($dirpath)) {
				// Throw empty dir Exception
			}
			$dirArray = explode('/', $dirpath);
			$dir = array_shift($dirArray);
			if(!in_array($dir, $this->ls())) {
				if(!@ftp_mkdir($this->_handler, $dir)) {
					// Throw cannot create dir Exception
				}
			}
			$this->cd($dir);
			if(empty($dirArray)) {
				$this->cd('/');
			} else {
				$this->mkdir(implode('/', $dirArray));
			}
		}
		
		/**
		 * Remove the directory given by $dirpath
		 *
		 * @access public
		 * @param string $path Path to remove, could be a file or a directory.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function rm($path) {
			$dirArray = explode('/', $path);
			$file_to_remove = array_pop($dirArray);
			$files = null;
			$this->cd(implode('/', $dirArray));
			if(!$this->__fileExists(implode('/', $dirArray), $file_to_remove)) {
				throw new FTPMFileNotExistsException($file_to_remove, implode('/', $dirArray));
			}
			if($this->__isDir($file_to_remove)) {
				$files = $this->ls($file_to_remove);
				if(!empty($files)) {
					throw new FTPMNotEmptyDirException($path);
				}
				if(!ftp_rmdir($this->_handler, $file_to_remove)) {
					throw new FTPMRemoveDirException($path);
				}
			} else {
				if(!ftp_delete($this->_handler, $file_to_remove)) {
					throw new FTPMDeleteFileException($path);
				}
			}
		}

		/**
		 * Return the current path.
		 *
		 * @access public
		 * @return boolean
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function pwd() {
			return @ftp_pwd($this->_handler);
		}
		
		/**
		 * Change current directory to $path.
		 *
		 * @access public
		 * @param string $path Path to a directory.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function cd($path) {
			if(!@ftp_chdir($this->_handler, $path)) {
				throw new FTPMCannotChangeDirException($path);
			}
		}
		
		/**
		 * Upload a file.
		 * This function upload a file on the FTP server in the directory given by $dest_dir.
		 * If the directory tree specified by $dest_dir doesn't it will be created.
		 *
		 * @access public
		 * @param string $filepath Your local path to the file you want to upload on the FTP server.
		 * @param string $dest_dir The destination directory on the FTP server where you want to upload your file.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function put($filepath, $dest_dir = null) {
			$fp = fopen($filepath, 'r');
			$dest = basename($filepath);
			if(isset($dest_dir) && !empty($dest_dir)) {
				$this->mkdir($dest_dir);
				$dest = $dest_dir.'/'.$dest;
			}
			if(!@ftp_fput($this->_handler, $dest, $fp, FTP_BINARY)) {
				throw new FTPMFilePutException($dest);
			}
		}
		
		/**
		 * Download a file from the FTP server.
		 *
		 * @access public
		 * @param string $filepath Path to a file on the FTP server.
		 * @param string $dest_dir Local path where you want to download the file.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function get($filepath, $dest_dir) {
			$pathArray = explode('/', $filepath);
			$filename = array_pop($pathArray);
			$filepath = implode('/', $pathArray);
			if(!$this->__fileExists($filepath, $filename)) {
				throw new FTPMFileNotExistsException($filepath, $filename);
			}
			@mkdir($dest_dir, 0777, true);
			$fp = fopen($dest_dir.'/'.$filename, 'w');
			if(!ftp_fget($this->_handler, $fp, $filepath.'/'.$filename, FTP_BINARY, 0)) {
				throw new FTPMFileGetException($filepath.'/'.$filename);
			}
		}
		
		/**
		 * FtpManager destructor.
		 * Close the open connection.
		 *
		 * @access public
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		public function __destruct() {
			if(!ftp_close($this->_handler)) {
				throw new FTPMDeconnectException();
			}
		}
		
		/**
		 * Private methods
		 */
		
		/**
		 * Parse an URL to separate URL infos from port.
		 * URL format should like the following :
		 * - www.monsite.com:8080
		 * - 192.168.0.56:4589
		 *
		 * @access private
		 * @param string $url
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		private function __parseUrl($url) {
			$urlArray = explode(':', $url);
			$this->_server_url = $urlArray[0];
			if(isset($urlArray[1])) {
				$this->_port = $urlArray[1];
			}
		}
		
		/**
		 * Check a given filename id a directory or a file.
		 * 
		 * @access private
		 * @param string $filename A file name corresponding to a directory or a file.
		 * @return boolean Return TRUE if $filename id a directory or FALSE if it's a file.
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		private function __isDir($filename) {
			if(@ftp_chdir($this->_handler, $filename)) {
				ftp_chdir($this->_handler, '..');
				return true;
			} else {
				return false;
			}
		}
		
		/**
		 * Check if a file or directory exists.
		 *
		 * @access private
		 * @param string $path Path to search if the file or directory exists.
		 * @param string $file File to search.
		 * @return boolean
		 * @author ADER Lionel <contact@korrigansoft.com>
		 */
		private function __fileExists($path, $file) {
			if(in_array($file, $this->ls($path))) {
				return true;
			} else {
				return false;
			}
		}
	}
