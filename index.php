<?php
include_once 'config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST" enctype="multipart/form-data">

        <input type="file" name="file" accept=".csv">
        <input type="submit" name="dugme" value="Proslijedi">

    
    
    </form>
</body>
</html>
<?php

if(isset($_POST['dugme'])){
    $fileName = $_FILES["file"]["tmp_name"];

        if($_FILES["file"]["size"] >0){
            $file = fopen($fileName, "r");

            while(($column = fgetcsv($file,10000, ",")) !== FALSE){
                $sql = "INSERT INTO podaci_csv (model_number,category_name,deparment_name,manufacturer_name,upc,sku,regular_price,sale_price,description,url) VALUE('" . $column[0] . "','" . $column[1]. "','" . $column[2]. "','" . $column[3]. "','" . $column[4]. "','" . $column[5]. "','" . $column[6]. "','" . $column[7]. "','" . $column[8]. "','" . $column[9] ."')";
                $result = mysqli_query($conn, $sql);

                if(!empty($result)){
                    echo "CSV podaci su ubaceni u bazu podataka" . "</br>";
                }else{
                    echo "Doslo je do problema" . "</br>";
                }
            
            }
        }
}

?>