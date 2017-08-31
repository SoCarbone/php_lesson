<?php

class Magician extends Character
{
   public function addDmage($char)
   {
       parent::addDamage($char);

       $char->Sleep($this->skill);

   }
}
