<?php include 'view/header.php' ?>

<body>

    <div class="container">

        <h1><?php echo $application_name; ?></h1>

        <div class="content connection">

            <h2>Inscription</h2>

            <p>Inscrivez vous pour connaitre la simplicité de notre CRM</p>

            <?php
            if(isset($_POST['user_email']))
            {
                if($verification_email == false)
                {
                    echo'<p class="error">L\'email n\'est pas au bon format : site@domaine</p>';
                }
                if($email['email'] == $enterring_email)
                {
                    echo'<p class="error">Cet email existe déjà</p>';
                }
            }
            elseif(isset($_POST['user_password']) AND isset($_POST['second_user_password']) AND ($user_password_hashed != $second_user_password_hashed))
            {
                echo'<p class="error">Il y a une erreur dans votre mot de passe.</p>';
            }
            ?>

            <form name="connection_form" method="post" action="register.php">

                <p class="form_row"><input type="text" name="user_email" placeholder="Votre email" <?php if(isset($_POST['user_email'])){echo $enterring_email;} ?>/></p>
                <p class="form_row"><input type="password" name="user_password" placeholder="Votre mot de passe"/></p>
                <p class="form_row"><input type="password" name="second_user_password" placeholder="Votre mot de passe à nouveau"/></p>
                <p class="form_row"><input type="submit" value="S'inscrire" class="bouton"/></p>

            </form>

            <a href="index.php" class="link txtright">Se connecter</a>

        </div>

    </div>

</body>

</html>
