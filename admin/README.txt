READ ME:
*********

This software is developed and copyrighted by HIOX Softwares.
This version is HRS rev2.0


Requirements:
==============
   * PHP Version 4 and above
   * Javascript should be enabled.
   * Mysql Version 4 and above

Features:
==========
a) HIOX Review script / software will help you to have a page / image review
system on each page.
b) User comments or notes should be verified by the admin before being
displayed on that page.
c) Can be used across any pages across any directories.
d) UI tool for admin to review, delete, edit user messages.
e) UI to delete emails using CheckBox.
f) Word Filter to avoid spam mails.
g) Admin can block the user IP Address.
h) Set different Colors for HRS from Web Interface.
i) Easy to install and is password protected.
j) Can be used as a article review system, image review script, web page feedback script.


Installation:
==============
Please take 5 minutes time and read installation instructions carefully and
completely! This will ensure a proper and easy installation 
  
Extracting files:
 a)  Unzip HRS_2_0.zip. to extract the files and folders.

Configuring a Database:
 a)  Create a database manually eg: “hrsdb”
 b)  In the browser execute the file HRS/install.php
 c)  Provide the database details like Username, Password, DBname, and Hostname.
 d)  This should install the product.
 e)  For Security reasons, please delete install.php from the server.

File Permission:
 Set read, write permission to the file HRS/auth/config.php

Admin Login:
 a) Go to the page HRS/index.php
 b) Use the admin user and password to login.
 c) From here you can manage comments, set spam filter, block IP.

Display Username and EmailId Automatically if user is login already:
 a) Just get and set username and emailid from your table and set to $name and $email variable in addcomment.php 
 
Display comment without reviewing:
 a) Just change the $stat variable to "Yes" display comment automatically. if $stat is "No" display comment after reviewing.

How to use Review System Script:
=================================
Embedding code:
 Just copy the code from “Get Code” to include the script any where.

Check and Edit Comments:
  User can check all the comments using “New Comments”, and edit the comments 
using “Edit Comments”.

Setting spam filter:
  User can set the spam words to be filtered using the option “Spam” option.

Blocking IP:
  User can specify the IP to be blocked using the option “IP Block”.

How to customize the look and feel:
  a) Colors of the different fields of the tool can be changed using the option
“Colors”.

Important: 
 An email will be sent whenever a new feedback is added using this script.
 The mail id to which the intimation is to be done has to be set in
addcomment.php file.
 change the email id "test@example.com" to your email id.


Release Version: HRS 2.0: 
Release Date     : 18/04/2007


Our team also involves in developing customized scripts and user specific
scripts. Any requirements on outsourcing or project/product development do get
in touch with us (support@hscripts.com).
On any suggestions mail to us at support@hscripts.com

Visit us at http://www.hscripts.com
Visit us at http://www.hioxindia.com
