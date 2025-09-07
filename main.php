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
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body>
    <div class="navbar" >
            <div class="logo">
                Herocom
            </div>
            <div class="navlink">
                <a href="./product.php"><div >PRODUCT</div></a>
                <?php
                    $profile='
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class=" text-white bg-[#98CD00] hover:bg-[#A4DD00] focus:ring-4 focus:outline-none focus:ring-[#08CB00] font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"> PROFILE <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown" class="z-10 hidden bg-[#B6FFA1] divide-y divide-[#54C392] rounded-lg shadow-sm w-44 dark:bg-[#54C392]">
                            <ul class="py-2 text-sm text-[#253900] dark:text-white" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="" class="block px-4 py-2 hover:bg-[#FFFADC] dark:hover:bg-gray-600 dark:hover:text-white">CART</a>
                            </li>
                            <li>
                                <a href="./profile.php" class="block px-4 py-2 hover:bg-[#FFFADC] dark:hover:bg-gray-600 dark:hover:text-white">EDIT PROFILE</a>
                            </li>
                            <li>
                                <a href="./logout.php" class="block px-4 py-2 hover:bg-[#FFFADC] dark:hover:bg-gray-600 dark:hover:text-white">LOG OUT</a>
                            </li>
                            </ul>
                        </div>
                        ';

                    $emsql =$con->prepare("SELECT token FROM customer");
                    $emsql->execute();
                    $user = $emsql->fetchAll();
                    $pr = false;
                    if(isset($_COOKIE['herouser'])){
                        foreach($user as $u){
                            // print_r($u);
                            if(password_verify($u['token'], $_COOKIE['herouser'])){
                                echo $profile;
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
