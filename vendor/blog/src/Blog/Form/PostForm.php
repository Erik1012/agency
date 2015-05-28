<?php

namespace Blog\Form;

use Zend\Form\Form;

class PostForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('post');
        $this->setAttribute('method', 'post');
		  $this->setAttribute('enctype','multipart/form-data');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'address',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Address',
            ),
        ));
		  $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));
		  $this->add(array(
            'name' => 'phone',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Phone',
            ),
        ));
		   $this->add(array(
            'name' => 'pictures',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Pictures',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}