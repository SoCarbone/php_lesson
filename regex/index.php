<?php
if (isset($_POST['texte']))
{
    $texte = htmlspecialchars($_POST['texte']); // For security
    $texte = nl2br($texte); // Create <br />

    $texte = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $texte);
    $texte = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $texte);
    $texte = preg_replace('#\[color=(red|blue|rellow|green|purple|olive)\](.+)\[/color\]#isU', '<span style="color:$1;">$2</span>', $texte);
    $texte = preg_replace('#(http[s]?:\/\/[a-z0-9._/-]+)\?((?:&amp;)?=?[a-z0-9._-])*#', '<a href="$0">$1</a>', $texte);
    $texte = preg_replace('#[a-z0-9._-]+@[a-z0-9._-]+#', '<a href="mailto:$0">$0</a>', $texte);

    echo $texte . '<br /><hr />';
}

?>

<p>
    Bienvenue dans le parser du Site du Zéro !<br />
    Nous avons écrit ce parser ensemble, j'espère que vous saurez apprécier de voir que tout ce que vous avez appris va vous être très utile !
</p>

<p>Amusez-vous à utiliser du bbCode. Tapez par exemple :</p>

<blockquote style="font-size:0.8em">
<p>
    Je suis un gros [b]Zéro[/b], et pourtant j'ai [i]tout appris[/i] sur http://www.siteduzero.com/index.php?page=3&skin=blue<br />
    Je vous [b][color=green]recommande[/color][/b] d'aller sur ce site, vous pourrez apprendre à faire ça [i][color=purple]vous aussi[/color][/i] !<br />
    Pour de plus amples informations vous pouvez écrire à contact@gmail.fr
</p>
</blockquote>

<form method="post" action="index.php">
<p>
    <label for="texte">Votre message ?</label><br />
    <textarea id="texte" name="texte" cols="50" rows="8"></textarea><br />
    <input type="submit" value="Montre-moi toute la puissance des regex" />
</p>
</form>
