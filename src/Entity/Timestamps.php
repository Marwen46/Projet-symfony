<?php


namespace App\Entity;

trait Timestamps 
{ 
  /**
   * @ORM\Column(type="datetime")
   */
  private $createdAt;
  /**
   * @ORM\PrePersist()
   */
  public function createdAt(){
    
    $this->createdAt= new \DateTime();
  
  }
 
}
