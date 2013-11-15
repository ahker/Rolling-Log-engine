Rolling-Log-engine
==================

cakephp rotating log file engine

 Note:
 
   Now you can able to read the log files and creating rotating log files.

Step 1:
Folder structure 
/Cakephp/app/Log/CakeLog.php

  create a Folder in your app directory in the name of Log 
  and copy paste the CakeLog.php file 
  
step 2:
Folder structure 
/Cakephp/app/Log/Engine/RollLog.php

  create Engine Folder inside the Log Folder here you need to copy paste 
  the RollLog.php file
  
Step 3:
  bootstrap Configation 

  
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


Note:
change your engine from FileLog to RollLog 

filesize defult 1kb 


Now you can able to read the log file using the below code in your app

CakeLog::read('error');
CakeLog::read('debug');

