<html>
<head>
<title>Process Uploaded File</title>
</head>
<body>
<?php
 
if ( move_uploaded_file($_FILES['uploadFile'] ['tmp_name'],
       "fotos/{$_FILES['uploadFile'] ['name']}")  )
      { 
 echo "The file has been successfully uploaded";
      }
else
      {
 echo "Sorry, there was a problem uploading your file.";
       }
 
?>
</body>
</html>
