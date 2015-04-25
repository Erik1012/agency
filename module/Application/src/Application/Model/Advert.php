<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Model;
class Advert
 {
     public $id;
     public $title;
     public $address;
     public $description;

     public function exchangeArray($data)
     {
         $this->id     = (!empty($data['id'])) ? $data['id'] : null;
         $this->title  = (!empty($data['title'])) ? $data['title'] : null;
         $this->address = (!empty($data['address'])) ? $data['address'] : null;
         $this->description = (!empty($data['description'])) ? $data['description'] : null;
     }
 }
?>