<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Model;

 use Zend\Db\TableGateway\TableGateway;

 class AdvertTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function get_all()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function get_advert($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function save_advert(Advert $advert)
     {
         $data = array(
             'address' => $advert->address,
             'title'  => $advert->title,
             'description'  => $advert->description,
				 'phone'  => $advert->phone,
				 'phone'  => date("Y-m-d"),
				 'pictures'  => $advert->pictures,
         );

         $id = (int) $advert->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->get_advert($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Advert id does not exist');
             }
         }
     }

     public function delete_advert($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
?>