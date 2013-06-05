1.Use the script

A simple web hit counter uses a shell script. The sample given in this document is based on Apache access logs. The counter is small, easy to learn and use.

[Shell script location]
	./acc_a.sh

[Script synopsis]
	acc_a.sh <needle_string> [log_path] 
	needle_string - an regular expression to specify URIs wanted to be counted in the location defined by the first parameter. (For example : ^(/track/|/wert/).*$)	
	log_path - the absolute directory of Apache log file(s) (default value when it's not specified : '/etc/httpd/logs/')

[Useage]	
	For example,we want to calculate the hit counts of URIs under '/track/' based on the Apache log directory '/home/ttguan/':
	*********************************************************
	* $ ./acc_a.sh /home/ttguan/ ^/track/.*$
	*********************************************************
	
	Also,you can define an alias for this shell so it can be used anywhere without giving the absolute path of the shell script. Moreover after the shell script is appended
	to '.bashrc' file, the alias is automatically registered with the operation system. Hence we do not need to add this aline time and time again whenever we start a terminal.
	
	How to add the alias to bashrc
	*********************************************************
	* $ echo 'alias hitcnter=/full-path/acc_a.sh >> .bashrc
	*********************************************************	
	
	Sample output after an execution of the shell script. There are two columns: hit count and it's corresponding URL ordered by the count desc.
	*********************************************************
	*	3793298	/track/xmlhttprequests/getuerbyrole.php			
	*	3668179	/track/xmlhttprequests/getrole.php
	*	1522492	/track/asig/displaya_q.php
	*	... ...
	*********************************************************
	
[NOTE]
	* To test the shell on a virtual machine such as VMware, please refer to the "VMware and SuSE Linux Notes" document in iRAM for detailed guidance on initial configuration.
	* To read more about this script, refer to a ppt at './share_slide/share_slide.ppt'.

2.How to run sample scripts in the ppt

The ppt elaborates how the shell script works by demonstrating its key commends with examples. Each example is matched with a script for us to run and test it. Therefore readers
can operate and learn each commend on their own. For example in the unzipped folder such as 'share_slide\slide_code_source\slide_page_3_redirects', there are two files 'redirects_exp.sh'
as script and 'text.txt' as source file about 'redirects' on the third page of the ppt.

[Prerequisite]
	We assume you are familiar with basic UNIX commands and at least one editor available in UNIX. We also hope you have basic knowledge of TCP/IP, networking protocols,especially HTTP protocols.