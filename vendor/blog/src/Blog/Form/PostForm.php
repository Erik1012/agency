<?php

namespace Blog\Form;

use Zend\Form\Form;
use Zend\Form\Element; 

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
            'name' => 'user_id',
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
                'label' => 'Заголовок',
            ),
        ));
        $this->add(array(
            'name' => 'address',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Адреса',
            ),
        ));
		  $this->add(array( 
            'name' => 'description', 
            'type' => 'Zend\Form\Element\Textarea', 
            'attributes' => array( 
                'required' => 'required', 
            ), 
            'options' => array(
					 'label' => 'Опис',
            ), 
        )); 
		  $this->add(array(
            'name' => 'phone',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Тел.',
            ),
        ));
		   $this->add(array(
            'name' => 'pictures',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Картинки',
            ),
        ));
			$this->add(array( 
            'name' => 'category_id', 
            'type' => 'Zend\Form\Element\Select', 
            'attributes' => array( 
                'required' => 'required', 
            ), 
            'options' => array( 
                'label' => 'Виберіть категорію:', 
                'value_options' => array(
                    '0' => 'Dropdown', 
                    '1' => 'Dropdown', 
                ),
            ), 
        )); 
			$this->add(array(
            'name' => 'latitude',
            'attributes' => array(
                'type'  => 'text',
					 'id' => 'latitude',
            ),
            'options' => array(
                'label' => 'Широта',
            ),
        ));
			$this->add(array(
            'name' => 'longitude',
            'attributes' => array(
                'type'  => 'text',
					 'id' => 'longitude',
            ),
            'options' => array(
                'label' => 'Довгота',
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