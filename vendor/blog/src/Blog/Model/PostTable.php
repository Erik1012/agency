<?php

namespace Blog\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class PostTable extends AbstractTableGateway
{
	protected $table = 'adverts';
	
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Post());
        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }
	 
	 public function get_post_by_user($id)
    {
        $resultSet = $this->select(array('user_id' => $id));
        return $resultSet;
    } 
	 
    public function getPost($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function savePost(Post $post)
    {
        $data = array(
            'title' => $post->title,
            'address'  => $post->address,
				'description'  => $post->description,
				'phone'  => $post->phone,
				'date'  => date("Y-m-d"),
				'pictures'  => $post->pictures,
				'category_id'  => $post->category_id,
				'latitude'  => $post->latitude,
				'longitude'  => $post->longitude,
				'user_id'  => $post->user_id,
        );
        $id = (int)$post->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getPost($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deletePost($id)
    {
        $this->delete(array('id' => $id));
    }
}