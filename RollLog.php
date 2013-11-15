<?php
App::uses('BaseLog', 'Log/Engine');
App::uses('Hash', 'Utility');

class RollLog extends BaseLog {

/**
 * Path to save log files on.
 *
 * @var string
 */
	protected $_path = null;

/**
 * Constructs a new File Logger.
 *
 * Config
 *
 * - `types` string or array, levels the engine is interested in
 * - `scopes` string or array, scopes the engine is interested in
 * - `file` log file name
 * - `path` the path to save logs on.
 * - `filesize` size of the log file.
 *
 * @param array $options Options for the FileLog, see above.
 */
	public function __construct($config = array()) {
		parent::__construct($config);
		$config = Hash::merge(array(
			'path' => LOGS,
			'file' => null,
			'types' => null,
			'scopes' => array(),
			'filesize' => '1024',
			), $this->_config);
		$config = $this->config($config);
		$this->_path = $config['path'];
		$this->_file = $config['file'];
		$this->_filesize = $config['filesize'];
		if (!empty($this->_file) && substr($this->_file, -4) !== '.log') {
			$this->_file .= '.log';
		}
	}

/**
 * Implements writing to log files.
 *
 * @param string $type The type of log you are making.
 * @param string $message The message you want to log.
 * @return boolean success of write.
 */
	public function write($type, $message) {
		$debugTypes = array('notice', 'info', 'debug');

		if (!empty($this->_file)) {
			$filename = $this->_path . $this->_file;


		} elseif ($type === 'error' || $type === 'warning') {
			$filename = $this->_path . 'error.log';
		} elseif (in_array($type, $debugTypes)) {
			$filename = $this->_path . 'debug.log';
		} else {
			$filename = $this->_path . $type . '.log';
		}
		$output = date('Y-m-d H:i:s') . ' ' . ucfirst($type) . ': ' . $message . "\n";
                $this->rolling($filename);
		return file_put_contents($filename, $output, FILE_APPEND);
	}
	/**
	* -creating rooling file
	*/

   public function rolling($filename){
    if(file_exists($filename)){
		$file = substr($filename,0,-4);
		if(filesize($filename) >= $this->_filesize){
    $log1 = $file . '_1.log';
    $log2 = $file . '_2.log';
    if(file_exists($log1)){			
				        rename($log1 ,$log2);
					rename($filename ,$log1);
				}
    else{
      rename($filename ,$log1);
        }	
			}
		}
	}

}
