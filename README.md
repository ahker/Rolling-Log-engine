Rolling-Log-engine
==================

cakephp rotating log file engine


Step 1:

  create a Folder in your app directory in the name of Log and inside the Log folder create Engine here you need to copy paste 
  the RollLog.php file
  
Step 2:
  in bootstrap 
  
  App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'RollLog',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
        'filesize'=> '702',//bytes default 1024bytes
));
CakeLog::config('error', array(
	'engine' => 'RollLog',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
	'filesize'=> '702',//bytes default 1024bytes
));

change your engine from FileLog to RollLog 

filesize defult 1kb 

