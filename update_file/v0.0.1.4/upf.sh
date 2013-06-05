#!/bin/bash

# -------------------------------------------------------------------
# Filename:    upf
# Revision:    0.0.1.4
# Date:        2012/07/04
# Author:      Luke
# Email:       zhsongdl@cn.ibm.com
# Description: 	This is a CVS assistant scripts,it could help us update
#				CVS code to server without typing password each time. 
#				You can make use of these scripts instead of creating your
#				own script, if they meet your needs. 
# -------------------------------------------------------------------
# Copyright:   2012 (c) PTT
# License:     GPL
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#
# you should have received a copy of the GNU General Public License
# along with this program.
#
# If any changes are made to this script, please mail me a copy of the changes
# -------------------------------------------------------------------
#Version 1.0
#The first one , can monitor the system memory
#Version 1.1
#Modify the method of the script ,more fast
#
#TO-DO 7:
#The authenticity of host 'cvs.pok.ibm.com (9.57.11.175)' can't be established.
#RSA key fingerprint is d6:96:01:4e:60:bf:4f:80:2c:77:ea:b9:e5:da:99:54.
#Are you sure you want to continue connecting (yes/no)? 

#BUG 1:
#zhangsong@cvs.pok.ibm.com's password: 
#zhangsong@cvs.pok.ibm.com's password: Permission denied, please try again.
#
#To install and use the script:
#
#1) Place the script inside your HOME directory
#   a.Set the permissions on the script to be executable.
#   b.Modify the script and set up your own password at line 118: password=XXXXXX
#
#2) Add an alias to bashrc
#	*********************************************************
#	* $ echo 'alias u=~/upf.sh >> ~/.bashrc
#	* $ source ~/.bashrc
#	*********************************************************
#
#3) Install 'expect' command if it dosen't installed on the target server before
#	Red Hat/Cent OS:	yum install expect
#	Ubuntu: 			apt-get install expect
#
#4) To start using the script 
#	a.Change directory to your application path which the code 
#	  will check-out and deploy on it.
#	*********************************************************
#	* $ cd /var/www/html/dev/track/
#	*********************************************************
#	b.Update your code using the alias of the script
#	*********************************************************
#	* $ u index.php
#	*********************************************************

# Define some colors first:
RED='\e[1;31m'
BLUE='\e[1;34m'
CYAN='\e[1;36m'
NC='\e[0m' # No Color

update_file=$1
location=$2
password=$3
file_version=""
#Define the username via executing the `whoami` command.
username=`whoami`
#Define the current path via executing the `pwd` command.
current_dir=`pwd`
#Define the temporary directory for the script.
tmp_dir=~/upf_tmp_dir
is_check='n'

#Set up CVS environment for PTT.
CVSROOT=:ext:cvs.pok.ibm.com:/home/cvsroot CVS_RSH=ssh;
export CVSROOT CVS_RSH

#Default configuration variables.
_DEFAULT_MODEL="track"
_DEV_PATH="/var/www/html/dev"
_STAGE_PATH="/var/www/html/ptt/App"


if [ "${location}" = "dev" ]; then
	location=_DEV_PATH
fi

if [ "${location}" = "stage" ]; then
	location=_STAGE_PATH
fi

if [ -z $location ]; then
	location=_STAGE_PATH
fi

if [ -z $password ]; then
	password=7fxes0hy
fi

if [ ! -f "$location/$update_file" ];
then
	if [ -f "$current_dir/$update_file" ];
	then
		location=$current_dir
	else
		echo -e "$RED Error: Invalid file - $location/$update_file not exist!$NC"
		echo -n -e " Do you want to check it out now?[y/n]"
		read is_check
	fi
fi

if [ "${is_check}" = "y" ]; then
	echo -e "$CYAN Please run following command manually:$NC"
	echo -e " cvs co $CYAN$_DEFAULT_MODEL/$update_file$NC"
	exit
fi

if [ ! -d "$tmp_dir" ]; then
	mkdir -p "$tmp_dir"
	chmod 777 -R "$tmp_dir"
	exit
fi

if [ ! -f $tmp_dir/uplog ];
then
	touch $tmp_dir/uplog
fi


cat > $tmp_dir/run-scratch-auto-pwd <<EOD
#!/usr/bin/expect

spawn $tmp_dir/scratch1
expect "password:"
send "$password\r"
expect eof
EOD
chmod 700 $tmp_dir/run-scratch-auto-pwd


#Check status of file.
cat > $tmp_dir/scratch1 <<EOD
#!/bin/sh
cvs status -v $update_file > $tmp_dir/cvs_version_list_tmp
EOD
chmod 700 $tmp_dir/scratch1 

#1st exec
cd $location
$tmp_dir/run-scratch-auto-pwd

echo Automatic sign-in please waiting for a while ... \r
echo -e "Lastest version of"$CYAN $update_file"$NC,please chose one:"
cat $tmp_dir/cvs_version_list_tmp | sed -n '11,$p;' | sed -n '1,20p;' | sed 's/^\s*//g' | sed 's/^$//g' > $tmp_dir/version_list_first_10
cat -n $tmp_dir/version_list_first_10
echo -n -e "Please chose one branch $CYAN[1-20]:$NC"
read version
file_version=`awk -vversion="$version" -F '\t' 'NR==version {print $1}' $tmp_dir/version_list_first_10 | sed 's/\s//g'`

echo -e "cvs update -j $CYAN$file_version $update_file$NC"
cat > $tmp_dir/scratch1 <<EOD
#!/bin/sh
cd $location
cvs update -j $file_version $update_file
EOD


cd $location
$tmp_dir/run-scratch-auto-pwd > $tmp_dir/update_result
$tmp_dir/scratch2
exit
cat $tmp_dir/update_result | egrep 'Merging' | awk -v loc=$location -v file=$update_file -v usr=$username -F ' ' '{print usr":"loc"/"file"(v"$6")"}' >> $tmp_dir/uplog

if cat $tmp_dir/update_result | grep 'conflicts' > /dev/null
then
	echo -e "$RED Error: "
	tail -2 $tmp_dir/update_result
	echo -n -e $NC"Would you like delete this file and retry?[y/n]"
	read isRetry
	if [ $isRetry == 'n' ];then
		exit
	fi
	echo -n -e $CYAN"Execute sudo command "
	sudo rm -rf $location/$update_file
	echo -e $NC
	$tmp_dir/run-scratch-auto-pwd
fi
exit
fi

cat $tmp_dir/update_result
