#!/bin/bash
pis_file=$1 #the absolute directory of file.
sectionIter=0
for i in pis_file
do

sectionName=`awk -F "\t" '$2==NULL {print $1}' $i | grep -v "^$"`

if [ ! -z $sectionName ]; then 
echo "s/^.*$/INSERT INTO ESTIMATE_SECTION VALUES(833735$sectionIter,\"$sectionName\",833735);\"&\"/g"
sectionIter=sectionIter+1
fi

#awk "INSERT INTO VALUE()" $i
done