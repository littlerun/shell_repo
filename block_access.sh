#!/bin/bash
echo -e "Deny from all\nAllow from "`/sbin/ifconfig eth0 | sed -n 2p | sed "s/\sBcast.*//g" | awk -F ":" '{print $2}'` > .htaccess
echo -e "\n<Files ./cache_rate.php>\n\tOrder Allow,Deny\n\tAllow from all\n</Files>"  >> .htaccess