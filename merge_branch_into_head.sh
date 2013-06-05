#!/bin/bash
weekly_publish_manual=$1
cvs_comment=$2
password=$3

tmp_dir=~/publish_tmp_dir


#Set up CVS environment for PTT.
if [ -z "$CVSROOT" ]
then
	CVSROOT=:ext:cvs.pok.ibm.com:/home/cvsroot CVS_RSH=ssh;
	export CVSROOT CVS_RSH
fi

if [ -z $password ]; then
	password=7fxes0hy
fi

if [ ! -d "$tmp_dir" ]; then
	mkdir -p "$tmp_dir"
	chmod 777 -R "$tmp_dir"
fi

# Defined sub script start ### ### 

# Function: Defined automatic run-script function 
# to run the scratch.
function runScript {

# Defined the scratch script here.
cat > $tmp_dir/run-scratch-auto-pwd <<EOD
#!/usr/bin/expect

spawn $1
expect "password:"
send "$password\r"
expect eof
EOD
chmod 700 $tmp_dir/run-scratch-auto-pwd

$tmp_dir/run-scratch-auto-pwd
}

# Defined functions end ### ### 

##################################################
# Main
##################################################

cat $weekly_publish_manual | grep "track\/.*(" | sed 's/[\(\)]/ /g' | sed 's/\s[vV]/ /g' | awk -F " " '{print "cvs update -j "$2" "$1}' > $tmp_dir/merge_file_list

cat $weekly_publish_manual | grep "track\/.*(" | sed 's/[\(\)]/ /g' | sed 's/\s[vV]/ /g' | awk -F " " '{print "cvs commit -m \"'$cvs_comment'\" "$1}' > $tmp_dir/commit_file_list

cat $weekly_publish_manual | grep "track\/.*(" | sed 's/[\(\)]/ /g' | sed 's/\s[vV]/ /g' | awk -F " " '{print "sudo cp ~/"$1" "$1}' > $tmp_dir/publish_file_list
cat $weekly_publish_manual | grep "track\/.*(" | sed 's/[\(\)]/ /g' | sed 's/\s[vV]/ /g' | awk -F " " '{print "diff ~/"$1" "$1}' > $tmp_dir/diff_file_list
#Merge code into head
cat $tmp_dir/merge_file_list | while cLine=`line`
do
	runScript "$cLine"
done

#compare files

#commit files

#publish files
