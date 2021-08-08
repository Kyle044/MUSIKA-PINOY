<?php
include_once 'class.php';

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition:attachment; filename=ExportedDb.com.xls");


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<table style="width:100%; border:1px solid black;">
<tr>
  <th>id</th>
  <th>email</th>
  <th>name</th>
  <th>password</th>
  <th>date</th>
  <th>access</th>
  <th>supporter</th>
</tr>
<?php $music->exportDB(); ?>
</table>
  </body>
</html>
