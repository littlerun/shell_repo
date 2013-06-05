
	1.Indroduction
	
	How to make a web hit counter based on Apache logs? Please think about it for a second.

	There are a lot of ways to solve this issues.Any of high-level programming language is ok,such as Java,Python,Perl or maybe PHP. But A log file always large,in confusion and tricky to understand. high-level languages will always be slower,ineptly or inefficiently.In brief,It not good with this sort of issues. We are trying to explore a better way to slove this ploblem.
	
	Can we slove this under OS level without any system programing? Alright! We can using a SHELL!
	
	Shell script for apache web server log file analysis:
	* acc_a.sh *
	
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

		You need deploy code to your web server manually.  
		
		To deploy 'acc_a.sh' please carry the steps below:
		
		1.Upload and save the script to the web server;   
		
		2.Add the read and write permissions to the current user of 'acc_a.sh':
		*********************************************************
		* $ chmod +x ./acc_a.sh
		*********************************************************	
		
		2.Make sure you have write and read access to the directory the logs are stored in,such as /etc/httpd/logs/;
		To view the the directory mode:
		*********************************************************
		* $ ls -l /etc/httpd/logs/
		*********************************************************	
		
		3.execute the script:
		*********************************************************
		* $ ./acc_a.sh /etc/httpd/logs/ 
		*********************************************************	
		
		4.A result file 'hit_count_result_final' will be created under the script directory when message "hit count finished" printed on screen, 
		
		Also,you can defined an alias for this shell and append it to '.bashrc' file:
		*********************************************************
		* $ echo 'alias hitcnter=/full-path/acc_a.sh >> .bashrc
		*********************************************************	
		
		Now when you login to your machine from a console '.bashrc' will be called,you can run the shell as an alias:
		*********************************************************
		* $ hitcnter
		*********************************************************				

		If you want test the shell on VM,please see the "VMware and SuSE Linux Notes" document in iRAM for detailed guidance on initial configuration.
	
	2.Using the PPT
	Here are a few last preliminary remarks that will help you maximize the value of this slide document.
	
	[Assumptions]
	We assume you are familiar with basic UNIX commands and at least one of the editors available in UNIX. We also assume you have basic knowledge of TCP/IP,networking protocols,most notably,HTTP protocols. This slide document is not intended to introduce the knowledges that previously mentioned.
	
	But here are some recommendations if you need above knowledges:
	1)Introduction to the Unix command line - Lab book[PDF]
	http://free-electrons.com/doc/unix_linux_introduction_labs.pdf
	2)Introduction to the Linux Command Shell For Beginners[PDF]
	http://vic.gedris.org/Manual-ShellIntro/1.2/ShellIntro.pdf
	3)Documentation of vim editor
	http://www.vim.org/docs.php
	4)Introduction to HTTP From Wikipedia
	http://en.wikipedia.org/wiki/Http

	[Example Codes]
	We’ve constructed real, working examples throughout the PPT. We’ve
	tried to find a good balance between including enough code in line with the narrative so that you can understand the code but not so much that the flow is interrupted with pages of code. 


	Slide_code_source/

		--- slide_page_3_redirects/ <- i/o redirect examples
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

		