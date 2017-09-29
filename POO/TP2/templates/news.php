<div class="container-fluid">
    <div class="container container-center">
        <a href="admin.php" class="btn btn-link">Administration</a>

        <?php if(!empty($_GET) AND isset($_GET['thenews'])) {

            foreach($manager->getOneNews($_GET['thenews']) as $object)
            { ?>
                <div class="jumbotron">
                    <h1 class="display-3"><?php echo $object->Title(); ?></h1>
                    <p class="lead"><?php echo $object->Content(); ?></p>
                    <hr class="my-4">
                    <p>Par <?php echo $object->Author(); ?>, le <?php echo $object->AddDate(); if($object->UpdateDate() !== '-') { echo ', modifié le <mark>'. $object->UpdateDate() .'</mark>'; }?></p>
                    <p class="lead">
                    <a class="btn btn-primary btn-lg" href="index.php" role="button">Retourner aux news</a>
                    </p>
                </div>
            <?php }
        }

        else { ?>
        <h1 class="text-center mb-5">Les 5 dernières news</h1>

        <div class="row">

                <?php
                    foreach($manager->getLastNews() as $object)
                    { ?>
                        <div class="col-sm-4">
                            <div class="card">
                              <div class="card-body">
                                <h4 class="card-title"><?php echo $object->Title(); ?></h4>
                                <p class="card-text"><?php echo substr($object->Content(), 0, 65) .'...'; ?></p>
                                <a href="index.php?thenews=<?php echo $object->Id(); ?>" class="btn btn-primary">Voir la news</a>
                              </div>
                            </div>
                        </div>
                    <?php }
                    ?>

        </div>
        <?php } ?>

    </div>
</div>
