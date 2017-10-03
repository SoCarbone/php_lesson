<article class="uk-article">

    <h1 class="uk-article-title"><a class="uk-link-reset" href=""><?= $news['title'] ?></a></h1>

    <p class="uk-article-meta">Written by <a href="#"><?= $news['author'] ?></a> on <?= $news['addDate'] ?>.</p>

    <p class="uk-text-lead"><?= $news['content'] ?></p>

    <div class="uk-grid-small uk-child-width-auto" uk-grid>
        <div>
            <a class="uk-button uk-button-text" href="#">5 Comments</a>
        </div>
    </div>

</article>
