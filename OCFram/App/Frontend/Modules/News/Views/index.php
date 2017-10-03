<div class="uk-grid uk-grid-large uk-grid-match" uk-grid>
    <?php
foreach ($newsList as $news)
{
    ?>
    <div class=" uk-width-1-1 uk-width-1-2@m">
        <div class="uk-card uk-card-default uk-box-shadow-small uk-box-shadow-hover-large">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <h3 class="uk-card-title uk-margin-remove-bottom">
                            <?= $news['title'] ?>
                        </h3>
                        <p class="uk-text-meta uk-margin-remove-top">
                            <?= $news['add_date'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="uk-card-body">
                <p>
                    <?= nl2br($news['content']) ?>
                </p>
            </div>
            <div class="uk-card-footer">
                <a href="news-<?= $news['id'] ?>.html" class="uk-button uk-button-text">Lire la suite</a>
            </div>
        </div>
        </div>
        <?php
}
?>
</div>
