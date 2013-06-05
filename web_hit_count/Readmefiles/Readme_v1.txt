A SHELL script for a web hit counter

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
	
	Sample output. A block of final result like the report text shows below:
	*********************************************************
	*	3793298	/track/xmlhttprequests/getuerbyrole.php			
	*	3668179	/track/xmlhttprequests/getrole.php
	*	1522492	/track/asig/displaya_q.php
	*	823322	/track/queue/allinqueue.php
	*	783851	/track/xmlhttprequests/getPrevStep.php
	*	753786	/track/time/xmldata.php
	*	461618	/track/index1.php
	*	285898	/track/time/start.php
	*	266794	/track/rep/user.php
	*	254337	/track/asig/displaya.php
	*	248017	/track/queue/attention.php
	*	233968	/track/files.php
	*	209826	/track/time/add.php
	*	202642	/track/proj/projmainpage.php
	*	196484	/track/time/today.php
	*	188215	/track/xmlhttprequests/roletouser.php
	*	177150	/track/xmlhttprequests/workflowtorole.php
	*	173288	/track/time/stop.php
	*	169118	/track/asig/alltask.php
	*	160450	/track/uploadfiles.php
	*	... ...
	*********************************************************
	
[Deployment]

	You need to deploy code to your web server manually.  
	
	To deploy 'acc_a.sh' please carry the steps below:
	
	Step 1.Upload and save the script to the web server;   
	
	Step 2.Add the read and write permissions to the current user of 'acc_a.sh':
	*********************************************************
	* $ chmod +x ./acc_a.sh
	*********************************************************	
	
	Step 3.Make sure you have write and read access to the directory the logs are stored in,such as /etc/httpd/logs/;
	To view the the directory mode:
	*********************************************************
	* $ ls -l /etc/httpd/logs/
	*********************************************************	
	
	Step 4.execute the script:
	*********************************************************
	* $ ./acc_a.sh /etc/httpd/logs/ 
	*********************************************************	
	
	Step 5.A result file 'hit_count_result_final' will be created under the script directory when message "hit count finished" printed on screen.
	
	Also,you can defined an alias for this shell and append it to '.bashrc' file:
	*********************************************************
	* $ echo 'alias hitcnter=/full-path/acc_a.sh >> .bashrc
	*********************************************************	
	
	Now when you login to your machine from a console,the script '.bashrc' will be called. You can run the shell as an alias:
	*********************************************************
	* $ hitcnter
	*********************************************************				

[NOTE]

	* If you want to test the shell on VM,please see the "VMware and SuSE Linux Notes" document in iRAM for detailed guidance on initial configuration.
	* If you want to know more details,please refer to the slide document './share_slide/share_slide.ppt'. 	
	* The script may not work at all if your account does not have write and read access to the logs directory.
	* The script are written for the PTT tools. You may need to provide the URI directory and path information as the 'key string' parameter for use on another server. 

2.Use the share slide

There are a slide file(.ptt format) details how to  implement the counter script. I hope it will help you maximize the value of this slide document.

[Slide file]

	./share_slide/share_slide.ppt

[Assumptions]

	We assume you are familiar with basic UNIX commands and at least one of the editors available in UNIX. We also assume you have basic knowledge of TCP/IP,networking protocols,most notably,HTTP protocols. This slide document is not intended to introduce the knowledges that previously mentioned.

	Here are some recommendations if you need above knowledges:
	1)Introduction to the Unix command line - Lab book[PDF]
	  http://free-electrons.com/doc/unix_linux_introduction_labs.pdf
	2)Introduction to the Linux Command Shell For Beginners[PDF]
	  http://vic.gedris.org/Manual-ShellIntro/1.2/ShellIntro.pdf
	3)Documentation of vim editor
	  http://www.vim.org/docs.php
	4)Introduction to HTTP From Wikipedia
	  http://en.wikipedia.org/wiki/Http

[Example Codes]

	Slide_code_source/

		--- slide_page_3_redirects/ <- I/O redirect examples
			--- redirects_exp.sh	
			--- text.txt
			
		--- slide_page_13_awk_sed/ <- 'awk' and 'sed' examples
			--- awk_sed_text_process.sh
			--- gateway_log
			
		--- slide_page_21_uniq/ <- 'uniq' example
			--- number_list
			--- uniq_exp.sh
			
		--- slide_page_23_tailf/ <- 'tailf' example
			--- tailf_exp.sh
			
		--- slide_page_30/ <- source of the web hit counter 
			--- acc_a.sh
			
			
			
			
Hi Sakula,

Thanks for you message,I will 