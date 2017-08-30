<?php include 'view/header.php' ?>

<body>

    <div class="container">

        <h1><?php echo $application_name; ?></h1>

        <div class="content connection">

            <h2>Connection</h2>

            <?php
            if(isset($_POST['user_email']) AND isset($_POST['user_password']))
            {
                if($verification_email == false)
                {
                    echo'<p class="error">L\'email n\'est pas connu</p>';
                }
                if($verification_password == false)
                {
                    echo'<p class="error">Le mot de passe est incorrect</p>';
                }
            }
            ?>

            <form name="connection_form" method="post" action="index.php">

                <p class="form_row"><input type="text" name="user_email" placeholder="Votre email" <?php if(isset($_POST['user_email'])){echo 'value="'. $enterring_email .'"';} ?>/></p>
                <p class="form_row"><input type="password" name="user_password" placeholder="Votre mot de passe"/></p>
                <p class="form_row"><input type="submit" value="Se connecter" class="bouton"/></p>

            </form>

            <a href="register.php" class="link txtright">S'inscrire</a>

        </div>

    </div>

</body>

</html>
