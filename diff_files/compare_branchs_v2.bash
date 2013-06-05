#!/usr/bin/ksh
#
# SCRIPT: compare_branchs.bash
# AUTHOR: Luke Zhang
# DATE: 04/04/2012
# REV: 0.0.0.1
#
# PURPOSE: This script will reading a branchs list file line-by-line. 
#	   and diff the branchs with the CVS version. 
#
# REV LIST:
#
#######################################################################
#
# NOTE: To output the timing to a file use the following syntax:
#
#    compare_branchs.bash branchs_list_file_to_process > output_file_name 2>&1
#
# The actual timing data is sent to standard error, file
# descriptor (2), and the function name header is sent
# to standard output, file descriptor (1).
#
#######################################################################
#
# set -n # Uncomment to check command syntax without any execution
# set -x # Uncomment to debug this script
# 
# cvs diff -N -b -B -w --ignore-all-space -r B2013_Layla_Release track 1>~/HEAD/diff_Layla_release
# cat ~/HEAD/diff_Layla_release | grep 'Index:' | sed 's/^Index: //g' > ~/HEAD/diff_Layla_release_filelist
# pcregrep -M 'Index: '$FILE_NAME'((\n|.)*(?=Index)|(\n|.)*$)' ~/HEAD/diff_Layla_release
# cat /home/ubuntu/HEAD/diff_Layla_release_B130301_LAYLA_REQ_991 | grep 'Index: track/MVC/model/assignment/DefaultAssignmentView.php' --after 100 | pcregrep -M 'Index: track/MVC/model/assignment/DefaultAssignmentView.php(?:\n|.)*(?=Index)'

#set -x

INFILE="$1"
MAIL_CONTENTS="$2"
MODEL="track"

function diff_branchs_from_list_file
{

while read LINE
do
    #echo "cvs diff -N -b -B -w --ignore-all-space -r "$LINE" "$MODEL" 2>/dev/null 1>~/HEAD/diff_Layla_release\n"
    cvs diff -N -b -B -w --ignore-all-space -r $LINE $MODEL 2>/dev/null 1>~/HEAD/diff_Layla_release_$LINE

    #echo "************************** Merge $LINE start *********************************************"
    cat ~/HEAD/diff_Layla_release_$LINE | grep 'Index:' | sed 's/^Index: //g' | while read FILE_NAME
    #cat $MAIL_CONTENTS | sed -n -e "/Merge\s*$LINE\s*to\s*B2013_Layla_Release/,/Merge\s*B130301_LAYLA_REQ_/ p" |  egrep '(Index:|\+\+\+)' | sed 's/^Index: //g' | sed 's/+++ //g' | while read FILE_NAME
	do
	       
	    ESCAPED_FILE_NAME=`echo $FILE_NAME | sed 's|/|\\\/|g'`
	    echo "$FILE_NAME"
	    #cat ~/HEAD/diff_Layla_release_$LINE |  sed -n -e "/Index: $ESCAPED_FILE_NAME/,/Index:/ p" | grep -v 'Index:'
	    :
	done    
    #echo "************************** Merge $LINE end *********************************************\n"
    :
done < $INFILE
}

diff_branchs_from_list_file
