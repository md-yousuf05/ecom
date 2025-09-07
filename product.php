<?php
$server = 'localhost';
$username = 'root';
$password = '12345';
$database = 'ecom';

$link = "mysql:host=$server;dbname=$database";
$con = new PDO($link,$username,$password);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body>
    <h1 style="text-align: center;">ALL PRODUCT CATEGORIES</h1>
    <div style="display: flex; justify-content:space-around;">
        <div>GROCERY</div>
        <div>CLOTHING</div>
        <div>ELECTRONICS</div>
    </div>
    <hr>
    <div id="grocery">
        <div class="grid grid-cols-3">
            <?php 
           $datasql = $con->prepare("select * from product where pcategory = 'grocery'; ") ;
           $datasql->execute();
           $data= $datasql->fetchAll();
           foreach($data as $d){
            ?>
            <div>
                <h2><?php echo $d['pname'];?></h2>
                <h3>Rs. <?php echo $d['pprice'];?></h3>
            </div>
            <?php }?>
        </div>
    </div>
    <div></div>
    <div></div>
</body>
</html>
