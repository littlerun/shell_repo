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
#
#cat diff_Layla_release_B2013_Layla_Release | sed -n -e '/Index: track\/MVC\/view\/page\/user\/acl_validation\/acl_revalidation_list.tpl/,/Index:/ p' | grep -v 'Index:'
# cat diff_Layla_release_B2013_Layla_Release | grep 'Index: track/MVC/view/page/user/acl_validation/acl_revalidation_list.tpl' --after 1000 | pcregrep -M 'Index: track/MVC/view/page/user/acl_validation/acl_revalidation_list.tpl(?:\n|.)*(?=Index)'
# cat diff_Layla_release_B2013_Layla_Release | grep 'Index: track/asig/popChangeSPDAndWeekAvailableHour.php' --after 1000 | pcregrep -M 'Index: track/asig/popChangeSPDAndWeekAvailableHour.php(?:\n|.)*(?=Index)'
# cat diff_Layla_release_B2013_Layla_Release | grep 'Index: track/db/dbstruc.2013.Layla.release.sql.txt' --after 1000 | pcregrep -M 'Index: track/db/dbstruc.2013.Layla.release.sql.txt(?:\n|.)*(?=Index)'
# cat diff_Layla_release_B2013_Layla_Release | grep 'Index: track/dept/updated.php' --after 1000 | pcregrep -M 'Index: track/dept/updated.php(?:\n|.)*(?=Index)'
# cat diff_Layla_release_B2013_Layla_Release | grep 'Index: track/inc/departclass.php' --after 1000 | pcregrep -M 'Index: track/inc/departclass.php(?:\n|.)*(?=Index)'
# cat diff_Layla_release_B2013_Layla_Release | grep 'Index: track/inc/userbean.php' --after 1000 | pcregrep -M 'Index: track/inc/userbean.php(?:\n|.)*(?=Index)'
# cat diff_Layla_release_B2013_Layla_Release | grep 'Index: track/inc/managers/AprvlsManager.php' --after 1000 | pcregrep -M 'Index: track/inc/managers/AprvlsManager.php(?:\n|.)*(?=Index)'
# cat diff_Layla_release_B2013_Layla_Release | grep 'Index: track/user/access_validation/controller/controller.ACLRevalidation.php' --after 1000 | pcregrep -M 'Index: track/user/access_validation/controller/controller.ACLRevalidation.php(?:\n|.)*(?=Index)'
# cat diff_Layla_release_B2013_Layla_Release | grep 'Index: Index: track/asig/popChangeSPDAndWeekAvailableHour.php' --after 1000 | pcregrep -M 'Index: Index: track/asig/popChangeSPDAndWeekAvailableHour.php(?:\n|.)*(?=Index)'
set -x

INFILE="$1"
MODEL="track"

function diff_branchs_from_list_file
{

while read LINE
do
    echo "cvs diff -N -b -B -w --ignore-all-space -r "$LINE" "$MODEL" 2>/dev/null 1>~/HEAD/diff_Layla_release\n"
    cvs diff -N -b -B -w --ignore-all-space -r $LINE $MODEL 2>/dev/null 1>~/HEAD/diff_Layla_release_$LINE
    cat ~/HEAD/diff_Layla_release_$LINE | grep 'Index:' | sed 's/^Index: //g' | while read FILE_NAME
	do
	    #grep 'Index: '$FILE_NAME --after 1000 | pcregrep -M 'Index: '$FILE_NAME'((\n|.)*?(?=\nIndex:\s)|(\n|.)*$)' ~/HEAD/diff_Layla_release_$LINE
		ESCAPED_FILE_NAME=`sed 's/\//\//g' $FILE_NAME`
		cat ~/HEAD/diff_Layla_release_$LINE |  sed -n -e '/Index: track\/MVC\/view\/page\/user\/acl_validation\/acl_revalidation_list.tpl/,/Index:/ p' | grep -v 'Index:'
	    :
	done    
    :
done < $INFILE
}


diff_branchs_from_list_file



