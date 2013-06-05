#!/bin/bash
#tailf will print out the last 10 lines of a file and then wait for the file to growing.
tailf  /var/log/httpd/access_log | grep 9.115.144.199