<?php

namespace Blog\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Post implements InputFilterAwareInterface
{
    public $id;
    public $title;
    public $address;
	 public $description;
	 public $phone;
	 public $date;
	 public $pictures;
	 public $category_id;
	 public $coordinates;
	 public $user_id;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->title  = (isset($data['title'])) ? $data['title'] : null;
        $this->address = (isset($data['address'])) ? $data['address'] : null;
		  $this->description = (isset($data['description'])) ? $data['description'] : null;
		  $this->phone = (isset($data['phone'])) ? $data['phone'] : null;
		  $this->date = (isset($data['date'])) ? $data['date'] : null;
		  $this->pictures = (isset($data['pictures'])) ? $data['pictures'] : null;
		  $this->category_id = (!empty($data['category_id'])) ? $data['category_id'] : null;
		  $this->coordinates = (isset($data['coordinates'])) ? $data['coordinates'] : null;
		  $this->user_id = (isset($data['user_id'])) ? $data['user_id'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
				$inputFilter->add($factory->createInput(array(
                'name'     => 'user_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'address',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
				$inputFilter->add($factory->createInput([ 
					'name' => 'description', 
					'required' => true, 
					'filters' => array( 
						 array('name' => 'StripTags'), 
						 array('name' => 'StringTrim'), 
					), 
					'validators' => array( 
					), 
			  ])); 
				$inputFilter->add($factory->createInput(array(
                'name'     => 'phone',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
				$inputFilter->add($factory->createInput(array(
                'name'     => 'pictures',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
				$inputFilter->add($factory->createInput([ 
					'name' => 'category_id', 
					'filters' => array( 
						 array('name' => 'StripTags'), 
						 array('name' => 'StringTrim'), 
					), 
					'validators' => array( 
						 array ( 
							  'name' => 'InArray', 
							  'options' => array( 
										 'haystack' => array(0,1) ,
									), 
							  ), 
						 ), 

					 
			  ]));
				
				$inputFilter->add($factory->createInput(array(
                'name'     => 'coordinates',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
    
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}