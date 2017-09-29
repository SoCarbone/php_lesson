<?php
//On inclue les fichiers Addendum nécessaires
require 'addendum/annotations.php';
require 'MyAnnotations.php';
require 'Character.php';

$reflectedClass = new ReflexionAnnotatedClass('Character');
