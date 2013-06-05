==== CVS assistant scripts ====

I am maintains a CVS assistant scripts,it could help us update CVS code to server without typing password each time. You can make use of these scripts instead of creating your own script, if they meet your needs. 

<syntaxhighlight lang="bash" line start="1" highlight="104" enclose="div">
::[[File:upf.sh]]
</syntaxhighlight>

===== To install the script ===== 

1) Place the script inside your HOME directory
   a. Set the permissions on the script to be executable.
   b. Modify the script and set up your own password at line 118: password=XXXXXX

2) Add an alias to bashrc
<source>
   $ echo 'alias u=~/upf.sh >> ~/.bashrc
   $ source ~/.bashrc
</source>
3) Install 'expect' command if it dosen't installed on the target server before

Red Hat/Cent OS:	
<source>
    $ yum install expect
</source>

Ubuntu: 		
<source>
    $ apt-get install expect
</source>

===== To using the script =====

1) To start using the script 
a. Change directory to your application path which the code will check-out and deploy on it.
<source>
    $ cd /var/www/html/dev/track/
</source>
b.Update your code using the alias of the script
<source>
    $ u index.php
</source>
2) Choose the version(branch) you want update,see below screen-shot:

::[[File:upf_image1.png]]

::[[File:upf_image2.png]]

After above prompt,the file has been updated!

3) If the file doesn't exist:

::[[File:upf_image3.png]]

