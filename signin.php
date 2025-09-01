<?php
$server = 'localhost';
$username = 'root';
$password = '12345';
$database = 'ecom';

$link = "mysql:host=$server;dbname=$database";
$con = new PDO($link,$username,$password);

$msg = ''; // store message for later

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $em = $_POST['email'];
    $ps = $_POST['pass'];

    $searchstmt = $con->prepare("SELECT * FROM customer WHERE email=?");
    try {
        $searchstmt->execute([$em]);
        $data = $searchstmt->fetchAll();

        if ($data == []) {
            $msg = '<center><a href="./signup.php"><h2 style="color:orange;">please sign up first </h2></a></center>';
        } else {
            $hp = $data[0]['pass'];
            if (password_verify($ps, $hp)) {
                // ✅ Set cookie before any echo
                $token = rand(111111111,999999999);
                $tkh = password_hash($token,PASSWORD_DEFAULT);
                $setrandm = $con->prepare("UPDATE customer SET token = ? WHERE email = ?");
                $setrandm->execute([$token,$em]);
                setcookie("herouser", $tkh, time() + (10 * 365 * 24 * 60 * 60), "/");
                setcookie("heroemail", $em, time() + (10 * 365 * 24 * 60 * 60), "/");
                $msg = '<center><h2 style="color:lightgreen;" id="success">signin success</h2></center>';
            } else {
                $msg = '<center><h2 style="color:red;">incorrect credential</h2></center>';
            }
        }
    } catch (PDOException $e) {
        $msg = 'Error occurred: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signin</title>
</head>
<body>
    <fieldset style="width: fit-content; margin:auto; margin-top:100px;text-align:center">
        <h1>signin</h1>
        <form action="./signin.php" method="post">
            <input type="email" name="email" placeholder="email" required> <br> <br>
            <input type="password" name="pass" placeholder="pass" required> <br> <br>
            <button type="submit">signin</button>
            <button type="reset">reset</button> <br> <br>
        </form>
        <a href="./signup.php"><button type="button">signup page</button></a>
    </fieldset>

    <!-- show messages -->
    <?php if ($msg) echo $msg; ?>

    <script>
        let success = document.getElementById('success');
        if (success) {
            setTimeout(() => { success.innerText = '';window.location.href = './main.php' }, 5000);
        }
    </script>
</body>
</html>
