#!/bin/bash
#redirects output from 'cat readme.txt' to a file.
$ cat text.txt
$ cat text.txt  > exp
#'>>' -- If file does exist, the output is appended to the existing file.
$ echo 'append content'  >> exp
#redirect standard error into a file.
$ ls /dev/123 2> deviceList