# userMgmt

**Project** 
Create sample user management with CRUD operation for Project exercise.

**Project Description**
Design and implement a production ready application for maintaining contact information.

**Expected functionality**
- List contacts
- Add a contact
- Edit contact
- Delete/Inactivate a contact

**Contact model fields**
- First Name
- Last Name
- Email
- Phone Number
- Status (Possible values: Active/Inactive)

**Folder structure of the application**
Module: userMgmt
- userMgmt.info.yml
- userMgmt.install
- userMgmt.routing.yml
- src
-- Controller
--- DisplayTableController.php
--- userMgmtController.php
-- Form
--- userMgmtForm.php
--- DeleteForm.php

**Steps & Instructions**
1) Install the module
2) During installation, the DB table 'usermgmt' schema is created with the help of userMgmt.install file
3) The User Management Module is managed by admin because of user's information security.
4) http://localhost/myprojectname/admin/usermgmt/add - This URL is used for Adding the User Imformation.
5) http://localhost/myprojectname/admin/usermgmt/index - This URL is used for list of user's.
6) Edit & Delete buttton is attached with every user's information for updating the data or delete.
7) Attached 'usermgmt.sql' SQL table with some sample information.
