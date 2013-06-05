#!/bin/bash
#
# SCRIPT: check_version_difference.bash
# AUTHOR: Bruce Zhang (jianzhdl@cn.ibm.com)
# DATE: 08/20/2012
# REV: 0.0.0.1
#
# PURPOSE: This script is used to replicate
#
#
# EXIT CODES:
#            0 ==> Normal execution.
#            1 ==> Exit for debuging
#            2 ==> Error occured.
#
# set -x # Uncomment to debug this script
#
# set -n # Uncomment to check the script.s syntax
#        # without any execution. Do not forget to
#        # recomment this line!
#
########################################
# REVISION LIST:
########################################
#
# IF YOU MODIFY THIS SCRIPT, DOCUMENT THE CHANGE(S)!!!
#
########################################
#
# Revised by:
# Revision Date:
# Revision:
#
##############################################
# DEFINE FILES AND GLOBAL VARIABLES HERE
##############################################

# Add /usr/local/bin to the PATH
PATH=/bin:/usr/bin:/usr/local/bin
SCRIPT_NAME=`basename $0`

# Define the highlight colors
RED='\e[1;31m'
BLUE='\e[1;34m'
CYAN='\e[1;36m'
NC='\e[0m' # No Color

# Define the default version containing all of the files this shell script will produce
RELEASE_VERSION=B2012_Bogart_Release
MAIN_VERSION=HEAD
NEED_CHECK_OUT=1

# Define the default CVS modle of this shell script will produce
CVS_MODULE=wert

# Define the default CVS variables
CVS_MODE=ext
CVS_USER=zhangjian
CVS_HOST=cvs.pok.ibm.com
CVS_REPOSITORY=/home/cvsroot

export CVSROOT=:$CVS_MODE:$CVS_USER@$CVS_HOST:$CVS_REPOSITORY

LOGFILE="/tmp/check_version_diff_"`date +%y%m%d`

##############################################
# DEFINE FUNCTIONS HERE
##############################################

function usage(){
	USEAGE="echo -e $BLUE$SCRIPT_NAME [$CYAN[RELEASE_VERSION [MODEL] [CVSROOT]]$BLUE|$CYAN[--local <VERSION_PATH> <HEAD_PATH>]$BLUE]$NC"
	EXP_1="echo -e $BLUE$SCRIPT_NAME$CYAN B2012_Bogart_Release :ext:zhangjian@cvs.pok.ibm.com:/home/cvsroot$NC"
	EXP_2="echo -e $BLUE$SCRIPT_NAME$CYAN --local /home/bruce/Bogart_Release/track /home/cvsroot/track$NC"
	cat <<EOF
Usage: 
  `$USEAGE`
  For example:
  1.Compare branch that named B2012_Bogart_Release with Head:
    `$EXP_1`
  2.Compare two versions with local path by specified directory name:
    `$EXP_2`
Options description:
    RELEASE_VERSION  --  Realease version you want to compare with main branch.
    MAIN_VERSION  --  The main version that need to be compare with.
    MODEL -- The Model name that want to compared with.
    CVSROOT --  Your CVSROOT variable value.
        
    --local -- compare the local directory directly 
        RELEASE_PATH -- The release branch local path.
        HEAD_PATH -- The main branch local path.
Compare differences between the main branch and release branch.
EOF
	exit                                                  
}

function set_release_version() {
	
	if [ `echo $1 | grep "^[[:alpha:][:alnum:]\-\_]*$"` ]
	then
		RELEASE_VERSION=$1
	else
		echo "error release version: $1"
		exit 2
	fi
}

function set_cvs_model() {
	if [ `echo $1 | grep "^[[:alpha:][:alnum:]\-\_]*$"`  ]
	then
		CVS_MODULE=$1
	else
		echo "error release model: $1"
		exit 2
	fi
}

function set_diff_paths() {
	if [ -d $1 ]
	then
		RELEASE_VERSION=$1
	else
		echo "invaild release path: $1"
		exit 2
	fi
	
	if [ -d $2 ]
	then
		MAIN_VERSION=$2
	else
		echo "invaild head path: $2"
		exit 2
	fi
}

function set_CVSROOT() {
	if [ `echo $1 | grep "^:[[:alpha:]]+:[[:alpha:][:alnum:]]+@[[:alnum:][:alpha:]\-\_\.]+:[[:alpha:]\/]+$"` ]
	then
		export CVSROOT=$1
	else
		echo "error CVSROOT: $1"
		exit 2
	fi
}


function your_choise () {
	choise=$1	
	
	case $choise in
		Y|y)
			return 0
			;;
		N|n)
			exit 0
			;;
		*)
			return 1
			;;
	esac
	
}


##############################################
# BEGINNING OF MAIN
##############################################

# Enclose the entire main part of the script in
# curly braces so we can redirect all output of
# the shell script with a single redirection
# at the bottom of the script to the $LOGFILE

{

#
# Find out is $LOGFILE exist
#
if [ -z $LOGFILE ]
then
	touch $LOGFILE
fi

#
# Check Parameters
#
if [ $# -gt 3 ]
then
	usage
fi

if [ `echo $1 | grep "\-\-help"` ]
then
	usage
fi

if  [ `echo $1 | grep "\-\-local"` ]
then
	if [ ! $# -eq 3 ]
	then
		usage
	fi
	
	set_diff_paths $2 $3
	NEED_CHECK_OUT=0
else
	case $# in
		1)
			set_release_version $1
			;;
		2)
			set_release_version $1
			set_cvs_model $2
			;;
		3) 
			set_release_version $1
			set_cvs_model $2		
			set_CVSROOT $3
			;;
		0)
			;;
	esac
fi


#
# Checkout Sources
#
if [ $NEED_CHECK_OUT -eq 1 ]
then
	echo ""
	echo "checkout version:$MAIN_VERSION into `pwd`/$MAIN_VERSION/"
	cvs co -R -d $MAIN_VERSION -r $MAIN_VERSION $CVS_MODULE || exit 1
	
	echo ""
	echo "checkout version:$RELEASE_VERSION into `pwd`/$RELEASE_VERSION/"
	cvs co -R -d $RELEASE_VERSION -r $RELEASE_VERSION $CVS_MODULE || exit 1
fi

#
# Check only files
#
#ONLY_FILELIST=/tmp/${RELEASE_VERSION}-${MAIN_VERSION}.diff.only
ONLY_FILELIST=/tmp/check_version_difference.temp.only
echo ""
echo "only files in $RELEASE_VERSION/"
diff -r -EBbw -q --exclude='CVS' --exclude='.#*'  -I "^[[:blank:]]*[{/]*\*" -I "^[[:blank:]]*$" -I "^[[:blank:]]*//" $RELEASE_VERSION/ $MAIN_VERSION/ | grep Only | grep -v $MAIN_VERSION | tee $ONLY_FILELIST
	
echo ""
INPUT=""
until your_choise $INPUT
do
read -p "Continue: [Y/N]?" INPUT
done


echo ""
echo "ignore only files to diff"
#DIFF_FILELIST=/tmp/${RELEASE_VERSION}-${MAIN_VERSION}.diff.withoutOnly
DIFF_FILELIST=/tmp/check_version_difference.temp.withoutOnly
diff -r -EBbw -q --exclude='CVS' --exclude='.#*'  -I "^[[:blank:]]*[{/]*\*" -I "^[[:blank:]]*$" -I "^[[:blank:]]*//" $RELEASE_VERSION/ $MAIN_VERSION/ | grep -v Only | awk '{print $2 " " $4}' >$DIFF_FILELIST

#
# Check differences
#
echo ""
echo "diffing..."
DIFF_RESULT=${DIFF_FILELIST}.result
rm -f $DIFF_RESULT
while read RELEASE_FILE MAIN_FILE
do
	#echo "+diff -dEBbw -I \"^[[:blank:]]*[{/]*\*\" -I \"^[[:blank:]]*$\" -I \"^[[:blank:]]*//\" --side-by-side -W 180 --suppress-common-lines $RELEASE_FILE $MAIN_FILE" | tee -a $DIFF_RESULT
	#diff -dEBbw -I \"^[[:blank:]]*[{/]*\*\" -I \"^[[:blank:]]*$\" -I \"^[[:blank:]]*//\" --side-by-side -W 180 --suppress-common-lines $RELEASE_FILE $MAIN_FILE | tee -a $DIFF_RESULT
	#tkdiff $RELEASE_FILE $MAIN_FILE
	echo "+diff -EBbw   -I \"^[[:blank:]]*[{/]*\*\" -I \"^[[:blank:]]*$\" -I \"^[[:blank:]]*//\"  $RELEASE_FILE $MAIN_FILE" | tee -a $DIFF_RESULT
	diff -EBbw  -I "^[[:blank:]]*[{/]*\*" -I "^[[:blank:]]*$" -I "^[[:blank:]]*//"  $RELEASE_FILE $MAIN_FILE >>$DIFF_RESULT
done <$DIFF_FILELIST

DIFF_NUMBER=`grep "^+diff" $DIFF_RESULT | wc -l | cut -f1 -d" "`

echo ""
echo "Done! $DIFF_NUMBER files are different. Please see diff results in $DIFF_RESULT"

} | 2>&1 tee -a $LOGFILE

###############################################
# END OF SCRIPT
###############################################

