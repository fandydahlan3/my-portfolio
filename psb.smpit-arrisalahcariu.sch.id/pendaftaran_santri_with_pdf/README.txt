Instructions:
1. Place this project in your web server (htdocs or www).
2. Create the database using the provided SQL (db_pendaftaran_santri.sql).
3. Install Dompdf library via Composer:
   - cd to project folder
   - composer require dompdf/dompdf
   (If you don't have composer, install it first or use any other PDF library)
4. Access:
   - formulir.php to add data
   - login.php -> tables.php to view data
   - tables.php has a button 'Export PDF' which links to export_pdf.php
5. export_pdf.php uses Dompdf. Make sure vendor/autoload.php exists after composer install.
