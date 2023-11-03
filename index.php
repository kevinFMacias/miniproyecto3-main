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
    <link rel="icon" href="assets/devchallenges.png">
    <link rel="stylesheet" href="resources/css/index.css">
    <title>Register | App de Autenticación</title>
</head>

<body>
    <div class="container" id="container">
        <div class="app-container">
            <div class="logo-container">
                <img id="dev-image" src="assets/devchallenges.svg" alt="devchangenges-logo" class="dev-logo">


                <div>
                    <button class="dark-button"><i id="mode_icon" class="fa-solid fa-moon moon-icon"></i></button>
                </div>


            </div>
            <div class="title">

                <h2>Join thousands of learners from around the world</h2>
            </div>
            <div class="content">
                <p>Master web development by making real-life projects. There are multiple paths for you to choose</p>
            </div>
            <form class="index-form" method="post" action="">
                <?php

                require_once "db/database.php";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST["email"];
                    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

                    $stmt = $connect->prepare("SELECT id FROM users WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        echo "<span class='error' >El correo ya existe</span>";
                    } else {
                        $stmt = $connect->prepare("INSERT INTO users (email, password_hash) VALUES (?, ?)");
                        $stmt->bind_param("ss", $email, $password);

                        if ($stmt->execute()) {
                            session_start();
                            $_SESSION["user_id"] = $stmt->insert_id;
                            header("Location: resources/views/editprofile.php");
                            exit();
                        } else {
                            echo "Error al registrar";
                        }
                    }
                }
                ?>
                <input style="background-color: inherit;" type="email" class="email" placeholder="Email" name="email"
                    title="Enter your email" required>
                <span class="material-symbols-outlined mail" style="color: #828282;">
                    mail
                </span>
                <input style="background-color: inherit;" type="password" class="password" placeholder="Password"
                    name="password" maxlength="8" title="Enter your password" required><span
                    class="material-symbols-outlined lock" style="color: #828282;">
                    lock
                </span>
                <input type="submit" value="Start coding now" class="button" name="submit">
            </form>

            <div class="social-media">
                <p class="select-media">or continue with these social profile</p>
                <div class="social-media-icons">
                    <img src="assets/Google.svg" alt="Goolge-logo">
                    <img src="assets/Facebook.svg" alt="Facebook-logo">
                    <img src="assets/Twitter.svg" alt="Twitter-logo">
                    <img src="assets/Gihub.svg" alt="Github-logo">
                </div>
                <p class="member">Already a member? <a href="resources/views/login.php">Login</a></p>
            </div>
        </div>
        <footer>
            <p>created by <span class="name">Kevin Macias</span></p>
            <p>devchallenges.io</p>
        </footer>
    </div>

    <script src="resources/javascript/index.js"></script>
</body>