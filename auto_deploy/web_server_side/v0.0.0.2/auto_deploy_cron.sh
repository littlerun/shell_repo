#!/bin/bash

# -------------------------------------------------------------------
# Filename:    auto_deploy_cron.sh
# Revision:    0.0.0.2
# Date:        2012/07/09
# Author:      Luke
# Email:       zhsongdl@cn.ibm.com
# Description: 	Auto deploy cron job
# -------------------------------------------------------------------
# Copyright:   2012 (c) IBM.COM
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

#Input log file 
#Log format example:
#	track/js/task_validate_dojo task_user_role.js,1.1.2.28,1.1.2.29
#	track/js/task_validate_dojo task_wse_add.js,1.1.2.29

# Define some colors first:
RED='\e[1;31m'
BLUE='\e[1;34m'
CYAN='\e[1;36m'
NC='\e[0m' # No Color

update_file=$1
ori_location=$2
password=$3
file_version=""
cvs_model=""
#Define the username via executing the `whoami` command.
username=`whoami`
#Define the current path via executing the `pwd` command.
current_dir=`pwd`
#Define the temporary directory for the script.
tmp_dir="/tmp/"
is_check='n'

#Default configuration variables.
_DEFAULT_MODEL="track"
_DEPLOY_PATH="/var/www/html/dev"
_CVS_PATH="./CVSROOT"
_DEPLOY_BACK_UP_PATH="${tmp_dir}/tmp/DEPLOY_BACK_UP/"
_LOG_FILE="commit_log"


#Set up CVS environment for SFT
export CVSROOT=:pserver:9.115.144.33:/myrepos


#Compare the new file commit within the 5 min's interval.
#The output result as the format below:
# 1a2,3
# > track/js/task_validate_dojo task_wse_add.js,1.1.2.29
# > track/js/task_validate_dojo task_wse_add.js,1.1.2.30
diff $_DEPLOY_BACK_UP_PATH/$_LOG_FILE  $_CVS_PATH/$_LOG_FILE | sed -n '2,$p;' | sed 's/>\s//g' > $tmp_dir/incremental_files


for i in $tmp_dir/incremental_files
do
#Using the commands below to process each line of log files,fetch it into check out commands
echo $i | sed "s/\s/\//g" | awk -F "," '{print "cvs co -r $3 $1"}' 
done


echo ori_location
echo cvs_model
exit

if [ ! -d "$tmp_dir" ]; then
	mkdir -p "$tmp_dir"
	chmod 777 -R "$tmp_dir"
fi

if [ ! -f $tmp_dir/uplog ];
then
	touch $tmp_dir/uplog
fi


echo -e "cvs update -j $CYAN$file_version $update_file$NC"
cat > $tmp_dir/update_file <<EOD
#!/bin/sh
cd $location
cvs update -j $file_version $update_file
EOD

cd $location
$tmp_dir/update_file > $tmp_dir/update_result
exit
cat $tmp_dir/update_result | egrep 'Merging' | awk -v loc=$location -v file=$update_file -v usr=$username -F ' ' '{print usr":"loc"/"file"(v"$6")"}' >> $tmp_dir/uplog

if cat $tmp_dir/update_result | grep 'conflicts' > /dev/null
then
	#TODO:conflicts processing.
fi
exit
fi

cat $tmp_dir/update_result

#Back the log file and overwrite the log which created 5 five minutes ago.
cp $_CVS_PATH/$_LOG_FILE $_DEPLOY_BACK_UP_PATH
