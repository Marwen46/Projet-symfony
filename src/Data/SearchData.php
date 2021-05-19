<?php

namespace App\Data;

use App\Entity\Categorie\Categorie;

class SearchData
{
  /**
  * @var string
  */
  public $q = '';
   
  /**
  * @var Categorie[]
  */
  public $categorie = [];
}