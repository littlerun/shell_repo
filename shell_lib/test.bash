#!/bin/bash
#
# SCRIPT: chk_passwd_gid_0.bash
#
# PURPOSE: This script searches the /etc/passwd
# for all non-root users who are a member of
# the system/root group, GID=0
#
###########################################
# DECLARE FILES AND VARIABLES HERE
###########################################


###########################################
# BEGINNING OF MAIN
###########################################

grepList="aaa" #init $grepList using NULL value
cat /etc/group | awk -F ':' '{print $1,$3}' | while read GNAME GID
do
	if [ $GNAME="root" ]
	then
	   if [ -z "$grepList" ]
	   then
	       grepList="$GID"
	   else
	       grepList="|$GID" 
	   fi
	fi
done

echo $grepList

exit
