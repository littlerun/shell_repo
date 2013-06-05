1.Use the script

A simple web hit counter uses a shell script.It's based on Apache access logs,fast and easy to use.

[Script file]
	./acc_a.sh

[Script synopsis]
	acc_a.sh [log path]  [key string]

[Script options]
	log path - as the location of Apache log file. (default:/etc/httpd/logs/)
	key string - as an regular expression that match certain request URIs of Apache log. (default:^(/track/|/wert/).*$)

[Useage]	
	For example,we want to calculate the hit counts of '/track/' URI,based on log files archive directory '/home/ttguan/':
	*********************************************************
	* $ ./acc_a.sh /home/ttguan/ ^/track/.*$
	*********************************************************
	
	Also,you can defined an alias for this shell and append it to '.bashrc' file:
	*********************************************************
	* $ echo 'alias hitcnter=/full-path/acc_a.sh >> .bashrc
	*********************************************************	
	
	Sample output. A block of final result like the report text shows below:
	*********************************************************
	*	3793298	/track/xmlhttprequests/getuerbyrole.php			
	*	3668179	/track/xmlhttprequests/getrole.php
	*	1522492	/track/asig/displaya_q.php
	*	... ...
	*********************************************************
	
[NOTE]
* To test the shell on VM,please see the "VMware and SuSE Linux Notes" document in iRAM for detailed guidance on initial configuration.
* To know more details,refer to './share_slide/share_slide.ppt'. 	

2.Use the share slide

There are a slide file(.ptt format) details how to implement the counter script. 

[Slide file]
	./share_slide/share_slide.ppt

[Assumptions]
	We assume you are familiar with basic UNIX commands and at least one of the editors available in UNIX. We also assume you have basic knowledge of TCP/IP,networking protocols,most notably,HTTP protocols.