Moodle UCA - Grade export for Apogée (moodle-grade-export_apogee)
==================================
Grade export plugin made to export a file with users grades which we can use in the Apogée software.

Requirements
------------
- Moodle 3.3 (build 2017051500) or later.<br/>
-> Tests made on Moodle 3.3 to 3.6.3 versions<br/>

Installation
------------
1. Local plugin installation

- Git way:
> git clone https://github.com/andurif/moodle-grade-export_apogee.git grade/export/apogee

- Download way:
> Download the zip from https://github.com/andurif/moodle-grade-export_apogee/archive/master.zip, unzip it in grade/export/ folder and rename it "apogee" if necessary.

2. Then visit your Admin Notifications page to complete the installation.  
  
Description / Working
------
<p> This plugin aim is to export a file with students' grades for a course or a grade item (test, assign...) which can be used in the Apogée software with SNW.
Because the Apogée software requires a formatted file with some informations we do not have in the moodle platform, we choose to work with an existing preformatted file,  
edited from the software and already with the entire list of student we want to grade (e.g example.csv file).<br/>
To summarize, this plugin will read the given file and will complete it with students' grades.
</p> 
<p>A form is made to ask the user to provide the preformatted file from Apogée, then to choose which grade item is used and the field delimiter used in the file if necessary.</p>
<p>One more step could be needed for a good working. You need to define in the <i>grade_export_apogee.php</i> file a const variable which will determine the start of the students' list.
In the file read, if this variable is met, it means the next lines will correspond to students lines where we need to add their grades.</p>

```php
<?php   
//Const variable used to define the start of the user list in the file. The use and the update of the file will start just after this line.
//It can be set to null if you do not want use delimiter and run every lines if the given file.
const STARTLIST_DELIMITER = 'XX_ETUDIANTS_XX';
```

<p>Note: to link file data and users stored in database, we use the <i>id number</i> field where we store the student code visible for example in our .csv file.<br/>
According to your configuration, it could be needed to change the <i>print_grades()</i> function of this same .php file to permit the link with another field of the mdl_user table.</p>


To do / Improvements
------
* Add a plugin configuration (define headers...).
* Use of the file dump.php ?
* Maybe juste provide the header file en then complete it with all enrolled users ? 
* Tests


About us
------
<a href="https://www.uca.fr">Université Clermont Auvergne</a> - 2018
