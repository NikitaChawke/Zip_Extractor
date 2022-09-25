<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Zip Extractor</title>
        <link rel="stylesheet" href="style.css"></link>
    </head>    
<body>
    <div class="center">
        <h2>Zip Extractor<hr></h2>
        <form method="POST" enctype="multipart/form-data" action="zip_project.php">
            <input class="zipform" type="file" name="upload-zip" accept=".zip">
            <input type="submit">
        </form>
    </div>
</body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data_files = $_FILES["upload-zip"];
   $path = $data_files["tmp_name"];
   $fname = rand(1,700000);
   $x = new ZipArchive();
   $temp = $x->open($path);
   if ($temp == true){
       $result = $x->extractTo("All_Data/".$fname);
       if($result){
            $block_close = $x -> close();
            if($block_close){
                $array = scandir("All_Data/".$fname);
                $length = count($array);
                for($i=2;$i<$length;$i++){
                    $my_link = "All_Data/".$fname."/".$array[$i];
                    echo "<p style='margin-left:50px;'><u>Click For Download File</u></p><a style='margin-left:50px; color:white; margin-top:30px;'
                } href='".$my_link."' download='".$my_link."'>".$array[$i]."</a><br>";
                }
                }
       }else{
        echo "unable to open file";
       }
   }else{
    echo "something wrong";
   }
}
    
?>