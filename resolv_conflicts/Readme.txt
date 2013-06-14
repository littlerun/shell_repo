How to use the script

A conflict can result from a merge operation. If that happens, you should resolve it before committing the new revision. This script will help you remove conflicts contents from your project directory and the useless symbol ^M will also removed by the script from each conflict files.

[Shell script location]
	./batch_process_conflicts.sh

[Script synopsis]
	batch_process_conflicts.sh [old|new] 
	old - Keep the previous contents before the update action.
	new - Keep the new contents that you want to update.

[Useage]	
	For example,when you enter the cvs commit command to automatically upload all the files you have changed or added to a project, the CVS repository server may inform you that your locally-edited files are not up-to-date with the server or that you need to manually merge one or more files with newer versions that have already been uploaded to the repository by a colleague. Here's a sample conflict warning message that occurred during a cvs commit process: 
	
	************************************************************************
	* <<<<<<< track/MVC/sod.tpl
	*	<td><img src="/img/sod-top-title.jpg" width="606" /></td>
	* =======
	*       <td align="top"><img src="/img/sod-top-title.jpg" width="886" /></td>
	* >>>>>>> 1.3.48.3
	************************************************************************

	To slove above issue,and keep the OLD contents from "<<<<<<<" and "======="

	*********************************************************
	* $ cd track	# Change directory to the project root
	* $ /path/batch_process_conflicts.sh old	# Run from it's path
	*********************************************************

	To slove above issue,and keep the NEW contents from "=======" and ">>>>>>>"

	*********************************************************
	* $ cd track
	* $ /path/batch_process_conflicts.sh new
	*********************************************************
	
	Also,you can define an alias for this shell so it can be used anywhere without giving the absolute path of the shell script. Moreover after the shell script is appended
	to '.bashrc' file, the alias is automatically registered with the operation system. Hence we do not need to add this aline time and time again whenever we start a terminal.
	
	How to add the alias to bashrc
	*********************************************************
	* $ echo 'alias proc_conflict=/full-path/batch_process_conflicts.sh >> ~/.bashrc
	* $ source ~/.bashrc
	*********************************************************	
	
	Sample output before vs after an execution of the shell script. There are two grep output below:

	Before execute the shell script:
	*********************************************************
	* $ grep '<<<<<<<' ./ -R
	*  ./PTTsupport.php:<<<<<<< PTTsupport.php
	*  ./admin.php:<<<<<<< admin.php
	*  ./admin.php:<<<<<<< admin.php
	*  ./admin.php:<<<<<<< admin.php
	*  ./prefs/admin.php:<<<<<<< admin.php
	*  ./asig/updatea_q.php:<<<<<<< updatea_q.php
	*  ./asig/updatea.php:<<<<<<< updatea.php
	*  ./asig/adda_q.php:<<<<<<< adda_q.php
	*  ./asig/adda.php:<<<<<<< adda.php
	*  ./asig/displaya.php:<<<<<<< displaya.php
	*  ./asig/displaya_q.php:<<<<<<< displaya_q.php
	*  ./js/reassignTo.js:<<<<<<< reassignTo.js
	* $	
	*********************************************************
	
	After execute the shell script:
	*********************************************************
	* $ grep '<<<<<<<' ./ -R
	* $
	*********************************************************
	

[Prerequisite]
	Before use this script,we assume you are familiar with basic UNIX commands and at least one editor available in UNIX. We also hope you have basic knowledge of TCP/IP, networking protocols,especially HTTP protocols.
