<?php
if(!empty($_POST) AND !isset($_GET['isModify']))
{
    $news = new News([
    'author' => $_POST['author'],
    'title' => $_POST['title'],
    'content' => $_POST['content'],
    'add_date' => $now,
    'update_date' => $now
    ]);

    $manager->addNews($news);

    header ('Location: admin.php?add=true');
}

if(!empty($_GET))
{
    if(isset($_GET['add']) AND $_GET['add'] == true)
    {
        $check_message = 'La news a été ajoutée !';
    }

    if(isset($_GET['delete']))
    {
        $manager->deleteNews($_GET['delete']);
        $check_message = 'La news a été supprimée';
    }

    if(isset($_GET['modify']))
    {
        foreach($manager->getOneNews($_GET['modify']) as $obj)
        {
            $id = $obj->Id();
            $author = $obj->Author();
            $title = $obj->Title();
            $content = $obj->Content();
            $add_date = $obj->AddDate();
        }
    }

    if(isset($_GET['isModify']) AND $_GET['isModify'] == true)
    {
        var_dump($_POST);
        $news = new News([
        'id' => $_POST['id'],
        'author' => $_POST['author'],
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'add_date' => $_POST['add_date'],
        'update_date' => $now
        ]);

        $manager->updateNews($news);

        header ('Location: admin.php?update=true');
    }

    if(isset($_GET['update']) AND $_GET['update'] == true)
    {
        $check_message = 'La news a été modifiée !';
    }

}
