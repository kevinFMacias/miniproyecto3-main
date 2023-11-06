<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,300,1,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="icon" href="../../assets/devchallenges.png">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login | App de Autenticación</title>
</head>

<body>
    <div id="container" class="container">
        <div class="margin">
            <div class="app-container">
                <div class="logo-container">
                    <img id="dev-image" src="../../assets/devchallenges.svg" alt="devchangenges-logo" class="dev-logo">

                    <div>
                        <button class="dark-button"><i id="mode_icon" class="fa-solid fa-moon moon-icon"></i></button>
                    </div>
                </div>
                <div class="title">

                    <h2>Login</h2>
                </div>

                <form class="index-form" method="post" action="login.php">
                    <?php

                require_once "../../db/database.php";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    $stmt = $connect->prepare("SELECT id, password_hash FROM users WHERE email = ?");

                    if ($stmt === false) {
                        die("Error en la consulta SQL: " . mysqli_error($connect));
                    }
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($id, $hashed_password);
                        $stmt->fetch();

                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            $_SESSION["user_id"] = $id;

                            header("Location: profile.php");
                            exit();
                        } else {
                            echo "<span class='error' >Contraseña incorrecta.</span>";
                        }
                    } else {
                        echo "<span class='error' >El usuario no existe</span>";
                    }
                }
                ?>


                    <input style="background-color: inherit;" type="email" class="email" placeholder="Email"
                        name="email">
                    <span class="material-symbols-outlined mail" style="color: #828282;">
                        mail
                    </span>
                    <input style="background-color: inherit;" type="password" class="password" placeholder="Password"
                        name="password"><span class="material-symbols-outlined lock" style="color: #828282;">
                        lock
                    </span>
                    <input type="submit" value="Login" class="button" name="login">
                </form>

                <div class="social-media">
                    <p class="select-media">or continue with these social profile</p>
                    <div class="social-media-icons">
                        <img src="../../assets/Google.svg" alt="Goolge-logo">
                        <img src="../../assets/Facebook.svg" alt="Facebook-logo">
                        <img src="../../assets/Twitter.svg" alt="Twitter-logo">
                        <img src="../../assets/Gihub.svg" alt="Github-logo">
                    </div>
                    <p class="member">Don't have an account yet?<a href="../../index.php"> Register</a></p>
                </div>
            </div>
            <footer>
                <p>created by <span class="name">Kevin Macias</span></p>
                <p>devchallenges.io</p>
            </footer>
        </div>
    </div>
    <script src="../javascript/login.js"></script>
</body>

</html>