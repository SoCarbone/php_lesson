<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>
        <?= isset($title) ? $title : 'Mon super site' ?>
    </title>

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/css/uikit.min.css" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="uk-navbar-container uk-margin" uk-navbar>
        <div class="uk-navbar-left">

            <a class="uk-navbar-item uk-logo" href="/">Mon site avec OCFram</a>

            <?php if($user->isAuthenticated()) { ?>
            <ul class="uk-navbar-nav">
                <li>
                    <a href="/admin/">
                    <span class="uk-icon uk-margin-small-right" uk-icon="icon: settings"></span>
                    Admin
                </a>
                </li>
                <li>
                    <a href="/admin/">
                    <span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
                    Ajouter une news
                </a>
                </li>
            </ul>
            <?php } ?>

        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="/admin/">
                    <span class="uk-icon uk-margin-small-right" uk-icon="icon: sign-in"></span>
                </a>
                </li>
            </ul>
        </div>

    </nav>

    <div class="uk-container">

        <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
            <?= $content ?>

    </div>
    <!-- /.container -->

    <!-- jQuery is required -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- UIkit JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/js/uikit-icons.min.js"></script>

</body>

</html>
