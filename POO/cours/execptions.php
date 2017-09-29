<?php

class MyException extends Exception // Nous pouvons hériter la class Exception
{
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return $this->message;
    }
}

class TheException extends ErrorException // Attraper toutes les erruers PHP et les transformer en exceptions
{
    public function __toString()
    {
        switch ($this->severity)
        {
            case E_USER_ERROR : //Erruer fatale
                $type = 'Erreur fatale';
                break;

            case E_WARNING : //Alerte
            case E_USER_WARNING : //Alerte utilisateur
                $type = 'Attention';
                break;

            case E_NOTICE : //Notice
            case E_USER_NOTICE : //Notice utilisateur
                $type = 'Note';
                break;

            default : //Erreur inconnue
                $type = 'Erreur inconnue';
                break;
        }

        return '<strong>' . $type . '</strong> : [' . $this->code . '] ' . $this->message . '<br /><strong>' . $this->file . '</strong> à la ligne <strong>' . $this->line . '</strong>';

    }
}

function error2exception($code, $message, $fichier, $ligne)
{
  // Le code fait office de sévérité.
  // Reportez-vous aux constantes prédéfinies pour en savoir plus.
  // http://fr2.php.net/manual/fr/errorfunc.constants.php
  throw new MonException($message, 0, $code, $fichier, $ligne);
}

function Ad($i1, $i2)
{
    if(!is_numeric($i1) OR !is_numeric($i2))
    {
        throw new MyException('Les deux paramètres doivent être des nombres');
    }

    return $i1 + $i2;
}

try
{
    echo Ad(12, 4). '<br />';
    echo Ad('blabla', 4). '<br />';
}

catch (Exception $e)
{
    echo 'Une exception a été lancée. Message: ' . $e->getMessage();
}

echo '<br />Fin du script';
