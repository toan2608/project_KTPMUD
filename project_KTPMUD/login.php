<?php
    session_start();
    $sessionId = $_SESSION['id'] ?? '';
    $sessionRole = $_SESSION['role'] ?? '';
    if ( $sessionId && $sessionRole ) {
        header( "location:index.php" );
        die();
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/icon/themify-icons/themify-icons.css">
    <title>Dashboard</title>
</head>

<body>

    <!--------------------------------- Main section -------------------------------->
    <section class="main">
        <div class="container">

            <div class="main__form">
                <div class="main__form--title text-center">Sig In</div>
                <div class="social-container">
                    <a href="https://www.facebook.com/hqhuy.bk/?show_switched_toast=0&show_invite_to_follow=0&show_switched_tooltip=0&show_podcast_settings=0&show_community_transition=0&show_community_review_changes=0&show_community_rollback=0&show_follower_visibility_disclosure=0" class="social"><i class="ti-facebook"></i></a>
                    <a href="#" class="social"><i class="ti-google"></i></a>
                    <a href="#" class="social"><i class="ti-linkedin"></i></a>
			    </div>
                <h4>or use your account</h4>
                <form action="login_core.php" method="GET">
                    <div class="form-row">
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-envelope left"></i>
                                <input type="text" name="email" placeholder="Email" required>
                            </label>
                        </div>
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-key"></i>
                                <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                <i id="pwd" class="fas fa-eye right"></i>
                            </label>
                        </div>
                        <div class="col col-12">
                            <label class="input">
                                <i id="left" class="fas fa-male left"></i>
                                <select name="role" id="Role">
                                    <option value="admins">Admin</option>
                                    <option value="managers">Manager</option>
                                    <option value="pharmacists">Pharmacist</option>
                                    <option value="salesmans">Salesman</option>
                                </select>
                            </label>
                        </div>
                        <input type="hidden" name="action" value="login">
                        <?php if ( isset( $_REQUEST['error'] ) ) {
                                echo "<h5 class='text-center' style='color:red;'>Email, Password & Role Doesn't match Or Something is Wrong</h5>";
                            }?>
                        <div class="col col-12">
                            <input type="submit" value="Submit">
                        </div> 
                    </div>
                </form>    
            </div>
        </div>
    </section>

    <!--------------------------------- #Main section -------------------------------->



    <!-- Optional JavaScript -->
    <script></script>
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="./assets/js/app.js"></script>
</body>

</html>
