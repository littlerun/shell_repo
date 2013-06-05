#!/bin/bash
#    [script synopsis]
#    acc_a.sh [log path]  [key string]
#    [script options]
#		log path - the location of Apache log file.
#		key string - as an regular expression that match certain request URIs of Apache log.

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
paste -d '\t' sum_result filename_result > log_result_track
sort -k2 log.result | uniq -f1 -u | sed 's/\s/\t/g' >> log_result_track
cat log_result_track | sort -rn > log_result_track_final

#Filter all static resource files.
cat log_result_track_final | egrep -v '\.(gif|jpg|jepg|bmp|png|js|css|meta)' > log_result_track_final_filt_media

echo final.log.result finished


#Impact
