#!/bin/bash
#awk/sed - text processing
cat gateway_log | egrep '^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{9}' | awk -F '|' '{print $3" "$8}' > number_list
cat number_list | sed 's/\s.*$/\tHi&,this is sms content./g' 