<?php 
/*Author: Ege PERIM*/

function write_log($value)
	{
		$fp = fopen('LOG_EVENT_HISTORY.txt', 'a');//opens file in append mode  
		fwrite($fp, "\n$value");    
		fclose($fp);  
	}


 ?>