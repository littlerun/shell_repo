#!/bin/bash
#
# SCRIPT: batch_process_conflicts.sh
# AUTHOR: Luke Zhang
# DATE: 05/10/2013
# REV: 0.0.1
#
# PURPOSE: This script help find all of the conflict files and 
#          reading them one by one to remove the conflict's content.
#
# REV LIST:
#
#         05/10/2013 - Luke Zhang
#         Initial the script.
#
#######################################################################
#
# NOTE: To output the timing to a file use the following syntax:
#
#    batch_process_conflicts.sh [old|new] > output_file_name 2>&1
#
#######################################################################
#
# set -n # Uncomment to check command syntax without any execution
# set -x # Uncomment to debug this script

remain_content_type="old"

#OUTFILE=writefile.out
#TIMEFILE="/tmp/loopfile.out"
#>$TIMEFILE
#THIS_SCRIPT=$(basename $0)

######################################
function usage
{
echo "USAGE: $THIS_SCRIPT is a batch script that used to remove the conflicted contents during the CVS merge"
echo "$THIS_SCRIPT [old|new]"
exit 1
}
######################################

function verify_files
{
diff $INFILE $OUTFILE >/dev/null 2>&1
if (( $? != 0 ))
then
    echo "ERROR: $INFILE and $OUTFILE do not match"
    ls -l $INFILE $OUTFILE
fi
}
######################################

function get_conflicts_file_list
{
grep \<\<\<\<\<\<\< ./ -R -l  | grep -v \.# 
}
######################################

function batch_process_conflicts_file
{

grep \<\<\<\<\<\<\< ./ -R -l  | grep -v \.# | while read LINE
do

    process_conflicts_file `echo "$LINE"` 
    :
done
}
######################################

function process_conflicts_file
{

echo "processing $1"

cp $1 $1.tmp

> $1
is_old_content=0
is_new_content=0

cat $1.tmp | sed 's///g' | sed 's/\"/\\\"/g' | while read LINE
do
    if [ 0 != `echo "$LINE" | grep -c '<<<<<<<'` ]; then
	echo "Match conflict: start $LINE"
 	is_old_content=1
	continue
    fi

    if [ 1 == $is_old_content ]; then
	    if [  0 != `echo "$LINE" | grep -c '======'` ]; then
		echo "Match conflict: middle $LINE"
                is_old_content=0
	 	is_new_content=1
		continue
	    elif [ "$remain_content_type" == "old" ]; then
			echo "$LINE" >> $1
			#printf '%s\n' $LINE >> $1 
	    else
		continue
	    fi
	continue
    fi
    
    if [ 1 == $is_new_content ]; then
	    if [  0 != `echo "$LINE" | grep -c '>>>>>>>'` ]; then
		echo "Match conflict: end $LINE"
                is_old_content=0
	 	is_new_content=0
		continue
	    elif [ "$remain_content_type" == "new" ]; then
			echo "$LINE" >> $1
			#printf '%s\n' $LINE >> $1 
			continue
	    else
		continue
	    fi
	continue
    fi

    #printf '%s\n' $LINE >> $1 
    echo "$LINE" >> $1
    :
done

rm -rf $1.tmp
}
######################################



######################################
########### START OF MAIN ############
######################################

echo "Starting conflicts Processing ..."
batch_process_conflicts_file
echo "Complete successfully."

