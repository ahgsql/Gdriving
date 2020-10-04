
# GDriving - Create Permanent and Direct Links for Yours Google-Drive Files

Codeigniter Project for creating downloadable-permanent direct links for hosted in authorized Google Account's Drive folders.

Installation:

 1. Create Empty Code Igniter Project, Replace **application** folder with **mine** and create empty folder named "files", lastly put tailwind.min.css file to root.
 2. Import gdrive.sql file into database
 3. Edit application/config/db.php with your db credentials.
 4. Create Google Project and Enable Google Drive API
 5. Create oAuth Client and Add ***yoursite***/auth/redirect to Authorized Redirect URL's
 6. Download **credentials.json** and put root folder *(along with application,system)*


Usage

 1. Create a user with phpMyadmin or use ali:12345 then login.
 2. Click **"Token Al"** (Get Token) button and allow this application to access your google drive folder.
 3. You will be able to see all of your folders and files, you can navigate between them, and click any file to open download screen.

TO-DOs:

✅ English Translation

✅ Save generated links to db and show to user.

⬜️ Create cache for faster loading speeds.

⬜️ Register Screen

