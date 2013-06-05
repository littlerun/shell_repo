




#!/bin/bash -x
PATH=/bin:/usr/bin:/usr/local/bin

RELEASE_VERSION=B2012_Bogart_Release
MAIN_VERSION=HEAD
CVS_MODULE=wert
export CVSROOT=:ext:zhangjian@cvs.pok.ibm.com:/home/cvsroot


#
# Check only files
#
ONLY_FILELIST=/tmp/${RELEASE_VERSION}-${MAIN_VERSION}.diff.only
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
DIFF_FILELIST=/tmp/${RELEASE_VERSION}-${MAIN_VERSION}.diff.withoutOnly
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
	echo "+diff -EBbw   -I \"^[[:blank:]]*[{/]*\*\" -I \"^[[:blank:]]*$\" -I \"^[[:blank:]]*//\"  $RELEASE_FILE $MAIN_FILE" | tee -a $DIFF_RESULT
	diff -EBbw  -I "^[[:blank:]]*[{/]*\*" -I "^[[:blank:]]*$" -I "^[[:blank:]]*//"  $RELEASE_FILE $MAIN_FILE >>$DIFF_RESULT
done <$DIFF_FILELIST

DIFF_NUMBER=`grep "^+diff" $DIFF_RESULT | wc -l | cut -f1 -d" "`

echo ""
echo "Done! $DIFF_NUMBER files are different. Please see diff results in $DIFF_RESULT"

