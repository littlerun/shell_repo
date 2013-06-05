#!/bin/bash

# Define some colors first:
RED='\e[1;31m'
BLUE='\e[1;34m'
CYAN='\e[1;36m'
NC='\e[0m' # No Color   


###########################################################
# Main for script
###########################################################

#grep '<<<<<<<' ./ -R -n --color | cat -n
grep '<<<<<<<' ./ -R | awk -F ":" '{print $1}' | sort | uniq | grep -v "Binary file" | grep -v "orig" | grep "php" | while read cFile
do
    echo -e "== $cFile start process ========"
    cp $cFile $cFile".orig"
    #cat $cFile # | while read cLine

    cat $cFile | while cLine=`line`
    do
      if [`echo $cLine | grep '<<<<<<<'`]; then
        startFilter='true'
      fi
      if [ $startFilter=='true' ]; then
          out_file=$cFile'_filter_log'
      else
      	  if [ `echo $cLine | grep '>>>>>>>'` ]; then
        	startFilter='false'
      	  fi
          out_file=$cFile'_new'
      fi
      cat $cLine >> $out_file
      if [ `echo $cLine | grep '===='` ]; then
        startFilter='true'
      fi
    done
    echo -e "======== $cFile end process ========"
done 
