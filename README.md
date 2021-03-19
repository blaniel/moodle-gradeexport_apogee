Moodle UCA - Grade export for Apogée (moodle-gradeexport_apogee)
==================================
Grade export plugin made to export a file with users grades which we can use in the Apogée software.

Requirements
------------
- Moodle 3.3 (build 2017051500) or later.<br/>
-> Tests made on Moodle 3.3 to 3.10.1 versions<br/>

Installation
------------
1. Local plugin installation

- Git way:
> git clone https://github.com/andurif/moodle-gradeexport_apogee.git grade/export/apogee

- Download way:
> Download the zip from https://github.com/andurif/moodle-gradeexport_apogee/archive/master.zip, unzip it in grade/export/ folder and rename it "apogee" if necessary or install it from the "Install plugin" page if you have the right permissions.

2. Then visit your Admin Notifications page to complete the installation.

3. Once installed, you should see new administration options:

> Site administration -> Grades -> Export settings -> File for Apogée -> startlist_delimiter

This option will determine the start of the users list in the .csv used file. If this variable is met, it means the next lines will correspond to students lines where we need to add their grades.
  
Description / Working
------
<p> This plugin aim is to export a file with students' grades for a course or a grade item (test, assign...) which can be used in the Apogée software with SNW.
Because the Apogée software requires a formatted file with some informations we do not have in the moodle platform, we choose to work with an existing preformatted file, edited from the software and already with the entire list of student we want to grade (e.g example.csv file) and that we will need to import in the plugin.<br/>
To summarize, this plugin will read the given file and will complete it with students' grades.
</p> 
<p>A form is made to ask the user to provide the preformatted file from Apogée, then to choose which grade item is used and the field delimiter used in the file if necessary.</p>
<p>The system will use the start list delimiter defined in the plugin configuration in order to indicate where this list of students starts in the file.<br/>
This setting was directly integrated in the plugin previous versions code but it is now an administation setting to add more flexibility.</p>

<p>Note: to link file data and users stored in database, we use the <i>id number</i> field where we store the student code visible for example in our .csv file.<br/>
According to your configuration, it could be needed for now to directly change the <i>print_grades()</i> function of this same .php file to permit the link with another field of the mdl_user table or from another column.</p>


To do / Improvements
------
* Define in the interface columns or values to use to match users (like we had the grades importation preview).
* Maybe juste provide the header file en then complete it with all enrolled users ? 
* More tests


About us
------
<a href="https://www.uca.fr">Université Clermont Auvergne</a> - 2020
