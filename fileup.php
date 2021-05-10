<?php
$k1=md5(microtime());
$k2=substr($k1,0,8);
$path="Uploads/".$k2;
mkdir($path);
if(move_uploaded_file($_FILES['fileToUpload']["tmp_name"],$path."/".$_FILES['fileToUpload']["name"]))
{
    echo "File uploaded successfully!";
} else{
    echo "Sorry, file not uploaded, please try again!";
}
?>
