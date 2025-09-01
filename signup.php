<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
</head>
<body>
    <?php
        $server = 'localhost';
        $username = 'root';
        $password = '12345';
        $database = 'ecom';

        $link = "mysql:host=$server;dbname=$database";
        $con = new PDO($link,$username,$password);
        // if($con){
        //     echo 'ok connection done';
        // }else{
        //     echo $con;
        // }
    ?>
        <fieldset style="width: fit-content; margin:auto; margin-top:100px;text-align:center">
        <h1>signup</h1>
        <form action="./signup.php" method="post">
            <input type="text" name="username" placeholder="username" required> <br> <br>
            <input type="email" name="email" placeholder="email" required> <br> <br>
            <input type="password" name="pass" placeholder="pass" required> <br> <br>
            <button type="submit" value="signup">signup</button>
            <button type="reset">reset</button>
        </form>
        <br>
        <br>
        <a href="./signin.php"><button>signin page</button></a>
    </fieldset>
    
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $un = $_POST['username'];
            $em = $_POST['email'];
            $ps = $_POST['pass'];

            $hps= password_hash($ps,PASSWORD_DEFAULT);

            $insertstmt = $con->prepare("INSERT INTO customer VALUES (?,?,?)");
            try{
                $insertstmt->execute([$un,$em,$hps]);
                echo '<center><h2 style="color:lightgreen;" id="success">signup success</h2></center>';
            }catch (PDOException $e) {
                echo 'Error occurred: ' . $e->getMessage();
            }
        }
    ?>
    <script>
        let success = document.getElementById('success')
        setTimeout(()=>{
            success.innerText =''
        },5000)
    </script>
</body>
</html>