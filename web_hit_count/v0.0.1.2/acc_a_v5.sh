#!/bin/bash
#	
#[Script synopsis]
#	acc_a.sh <needle_string> [log_path]
# 
#	needle_string - an regular expression to specify URIs wanted to be counted in the location defined by the first parameter. 
#	(For example : (/track/|/wert/).*$)
#	
#	log_path - the absolute directory of Apache log file(s) 
#	(default value when it's not specified : '/etc/httpd/logs/')


keyString=$1 #an regular expression to specify URIs wanted to be counted in the location.
logPath=$2 #the absolute directory of Apache log file(s) .

if [ -z $logPath ];	#If the bash have not received 1st argument.
then
logPath=./ #Set default path for Apache logs.
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
awk '$9 == 200 {print $7}' $i | egrep -i $keyString |sort|uniq -c|sed 's/^ *//g' | sed 's/\?.*$//g' | sed 's/id\/[0-9]*$//g'  > $i.result
cat $i.result >> log.result #Append current log contents to the existing 'log.result' file
echo $i.result finished
done
echo final.log.result ... 

#Generate Final Results 

#Sort and unique lines in the file.
sort -k2 log.result | uniq -f1 --all-repeated=separate > separate_result 

#Sort and unique lines in the file, and then sum the total number of each request URI.
cat separate_result | sed 's/\s.*$//g' | awk '/[ \t]*$/&&sum!=0{print sum;sum=0;next}{sum+=$1}' > sum_result

#Unique request URI.
cat separate_result | awk -F " " '{print $2}' | uniq | sed /$/d > filename_result

#erge lines of 'sum_result' and 'filename_result'
paste -d '\t' sum_result filename_result > hit_count_result
sort -k2 log.result | uniq -f1 -u | sed 's/\s/\t/g' >> hit_count_result
#Filter all static resource files.
cat hit_count_result | sort -rn | egrep -v '\.(gif|jpg|jepg|bmp|png|js|css|meta)' > hit_count_result_final
echo hit count finished