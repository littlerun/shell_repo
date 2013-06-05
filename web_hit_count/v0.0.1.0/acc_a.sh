#!/bin/bash
#	
#    [Script synopsis]		
#		acc_a.sh [log path]  [key string]
#    
#	[Script options]
#		log path - as the location of Apache log file. (default:/etc/httpd/logs/)
#		key string - as an regular expression that match certain request URIs of Apache log. (default:^(/track/|/wert/).*$)
#
#	[Useage]	
#		For example,we want to calculate the hit counts of '/track/' URI,based on log files archive directory '/home/ttguan/':
#		*********************************************************
#		* $ ./acc_a.sh /home/ttguan/ ^/track/.*$
#		*********************************************************
#		
#		Sample output. A block of final result like the report text shows below:
#		*********************************************************
#		*	3793298	/track/xmlhttprequests/getuerbyrole.php			
#		*	3668179	/track/xmlhttprequests/getrole.php
#		*	1522492	/track/asig/displaya_q.php
#		*	823322	/track/queue/allinqueue.php
#		*	... ...
#		*********************************************************


logPath=$1 #the location of Apache log file.
keyString=$2 #an regular expression that match certain request URIs of Apache log.

if [ -z $logPath ];	#If the bash have not received 1st argument.
then
logPath=/etc/httpd/logs/ #Set default path for Apache logs.
fi

if [ -z $keyString ]; #If the bash have not received 2nd argument.
then
keyString='^(/track/|/wert/).*$' #Set default regular expression.
fi

if ls ./*.result &> /dev/null #If there are any .result files in the current directory
then
rm *.result -rf #Remove all matchs file.
fi

touch log.result

for i in $logPath/access_log.* #We declare i to be the variable that will take the different files contained in $logPath/access_log.*. 
do
echo $i ... #Print file path and name to screen.
#Using the commands below to process each line of log files,print all succeeded request, and then counts the number of each request.
awk '$9 == 200 {print $7}' $i|egrep -i $keyString|sort|uniq -c|sed 's/^ *//g' | sed 's/\?.*$//g' | sed 's/id\/[0-9]*$//g' | > $i.result
cat $i.result >> log.result #Append current log contents to the existing 'log.result' file
echo $i.result finished
done
echo final.log.result ... 

#Generate Final Results 

#Sort and unique lines in the file.
sort -k2 log.result | uniq -f1 --all-repeated=separate > separate_result 

#Sort and unique lines in the file, and then sum the total number of each request URI.
cat separate_result | sed 's/\s.*$//g' | awk '/^[ \t]*$/&&sum!=0{print sum;sum=0;next}{sum+=$1}' > sum_result

#Unique request URI.
cat separate_result | awk -F " " '{print $2}' | uniq | sed /^$/d > filename_result

#Merge lines of 'sum_result' and 'filename_result'
paste -d '\t' sum_result filename_result > hit_count_result
sort -k2 log.result | uniq -f1 -u | sed 's/\s/\t/g' >> hit_count_result
#Filter all static resource files.
cat hit_count_result | sort -rn | egrep -v '\.(gif|jpg|jepg|bmp|png|js|css|meta)' > hit_count_result_final
echo hit count finished