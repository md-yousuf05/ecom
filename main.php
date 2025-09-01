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
    <link rel="stylesheet" href="./main.css">
    <title>Document</title>
</head>
<body>
    <div class="navbar" >
            <div class="logo">
                Herocom
            </div>
            <div class="navlink">
                <div>PRODUCT</div>
                <?php
                    $emsql =$con->prepare("SELECT token FROM customer");
                    $emsql->execute();
                    $user = $emsql->fetchAll();
                    $pr = false;
                    if(isset($_COOKIE['herouser'])){
                        foreach($user as $u){
                            // print_r($u);
                            if(password_verify($u['token'], $_COOKIE['herouser'])){
                                echo '<div>PROFILE</div> - <a href="logout.php">logout</a>';
                                $pr = true;
                                break;
                            }
                        }
                        if($pr==false){
                            echo '<a href="./signup.php"><div>SIGN UP</div></a>';
                            echo '<a href="./signin.php"><div>SIGN IN</div></a>';

                        }
                    }else{
                        echo '<a href="./signup.php"><div>SIGN UP</div></a>';
                        echo '<a href="./signin.php"><div>SIGN IN</div></a>';
                    }
                ?>
            </div>
    </div>
</body>
</html>