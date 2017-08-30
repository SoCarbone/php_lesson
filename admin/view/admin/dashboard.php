<?php include 'view/header.php' ?>

<body>

    <div class="container">

        <h1>
            <?php echo $application_name; ?>
        </h1>

        <div class="content">

            <h2 class="txtcenter">Bonjour <?php if(!empty($_SESSION['first_name'])){echo $_SESSION['first_name'];} ?> !</h2>

            <div class="row">
                <div class="col col6">

                    <h3>Vos informations personnelles</h3>

                    <?php
                    if(isset($_POST['user_email']))
                    {
                        if($verification_email == false)
                        {
                            echo'<p class="error">L\'email n\'est pas connu</p>';
                        }
                    }
                    ?>

                    <form name="data_user_form" method="post" action="dashboard.php">

                        <p class="form_row"><input type="text" name="first_name" placeholder="Votre prénom" <?php if(isset($user_data['first_name'])){echo 'value="'. $user_data['first_name'] . '"';} ?> required/></p>
                        <p class="form_row"><input type="text" name="last_name" placeholder="Votre nom" <?php if(isset($user_data['last_name'])){echo 'value="'. $user_data['last_name'] . '"';} ?> required/></p>
                        <p class="form_row"><input type="text" name="email" placeholder="Votre email" <?php if(isset($user_data['email'])){echo 'value="'. $user_data['email'] . '"';} ?> required/></p>
                        <p class="form_row"><input type="text" name="siret" placeholder="Votre SIRET" <?php if(isset($user_data['siret']) AND $user_data['siret'] != 0){echo 'value="'. $user_data['siret'] . '"';} ?> required/></p>
                        <p class="form_row">
                            <select name="social_security" required>
                                <option value="AGESSA" >AGESSA</option>
                                <option value="MDA" >Maison des artistes</option>
                            </select>
                        </p>
                        <p class="form_row"><input type="submit" value="Mettre à jour" class="bouton"/></p>

                    </form>

                </div>

                <div class="col col6">

                    <h3>Vos informations de sécurité</h3>

                    <p>Vous pouvez modifier votre mot de passe</p>

                    <?php
                    if(isset($_POST['actual_password']))
                    {
                        if($existing_password == false)
                        {
                            echo'<p class="error">Ce n\'est pas votre mot de passe actuel</p>';
                        }
                    }
                    if(isset($_POST['new_password_1']) AND isset($_POST['new_password_2']))
                    {
                        if($similarity_password == false)
                        {
                            echo'<p class="error">Rentrez deux nouveaux mots de passe identiques</p>';
                        }
                    }
                    ?>

                    <form name="update_password_form" method="post" action="dashboard.php">

                        <p class="form_row"><input type="password" name="actual_password" placeholder="Votre mot de passe actuel" required/></p>
                        <p class="form_row"><input type="password" name="new_password_1" placeholder="Nouveau mot de passe" required/></p>
                        <p class="form_row"><input type="password" name="new_password_2" placeholder="Nouveau mot de passe à nouveau" required/></p>
                        <p class="form_row"><input type="submit" value="Modifier" class="bouton"/></p>

                    </form>

                </div>
            </div>

            <form name="logout" method="post" action="dashboard.php">

                <input type="hidden" name="logout" value="true"/>
                <p class="form_row"><input type="submit" value="Se déconnecter" class="link"/></p>

            </form>

        </div>

    </div>

</body>

</html>
