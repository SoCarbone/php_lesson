<div class="container-fluid">
    <div class="container container-center">
        <a href="index.php" class="btn btn-link">Voir les news</a>

        <h1 class="text-center">Administration des news</h1>

        <form name="" method="post" action="admin.php<?php if(isset($_GET['modify'])) { echo '?isModify=true'; } ?>" class="mt-5">

            <div class="form-group">
                <label for="author">Auteur*</label>
                <input type="text" class="form-control" id="author" name="author" value="<?php if(isset($_GET['modify'])) { echo $author; } ?>" placeholder="Qui êtes vous ?" required>
            </div>

            <div class="form-group">
                <label for="title">Titre*</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($_GET['modify'])) { echo $title; } ?>" placeholder="De quoi allez-vous parler ?" required>
            </div>

            <div class="form-group">
                <label for="content">Le contenu de votre news*</label>
                <textarea class="form-control" id="content" name="content" rows="5" required><?php if(isset($_GET['modify'])) { echo $content; } ?></textarea>
            </div>
            <p class="small">*Mentions obligatoires</p>
            <?php if(isset($_GET['modify'])) {
            ?>
            <input type="hidden" class="form-control" id="" name="add_date" value="<?php if(isset($_GET['modify'])) { echo $add_date; } ?>">
            <input type="hidden" class="form-control" id="" name="id" value="<?php if(isset($_GET['modify'])) { echo $id; } ?>">
            <?php
            } ?>

            <input type="submit" class="btn btn-primary" value="Enregistrer la news" />

        </form>

        <?php if(isset($check_message)) {
        ?>

            <div class="alert alert-success mt-3" role="alert"><?php echo $check_message; ?></div>

        <?php
        } ?>


        <div class="display-news mt-5">

            <p class="text-center">Il y a actuellement <?php echo $manager->Count(); ?> news :</p>

            <table class="table table-striped">
                <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Auteur</th>
                        <th>Titre</th>
                        <th>Date d'ajout</th>
                        <th>Dernière modification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($manager->getAllNews() as $object)
                    { ?>
                        <tr>
                        <th scope="row"><?php echo $object->Id(); ?></th>
                        <td><?php echo $object->Author(); ?></td>
                        <td><?php echo $object->Title(); ?></td>
                        <td><?php echo $object->AddDate(); ?></td>
                        <td><?php echo $object->UpdateDate(); ?></td>
                        <td><a href="admin.php?modify=<?php echo $object->Id(); ?>" class="">Modifier</a> | <a href="admin.php?delete=<?php echo $object->Id(); ?>" class="">Supprimer</a></td>
                    </tr>
                    <?php }
                    ?>
                </tbody>
            </table>

        </div>

    </div>
</div>
