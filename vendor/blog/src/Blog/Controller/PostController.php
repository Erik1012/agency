<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController,
	Zend\View\Model\ViewModel,
	Blog\Model\Post,
	Blog\Form\PostForm;   

class PostController extends AbstractActionController
{

	protected $postTable;
	protected $categoryTable;

    public function getPostTable()
    {
        if (!$this->postTable) {
            $sm = $this->getServiceLocator();
            $this->postTable = $sm->get('Blog\Model\PostTable');
        }
        return $this->postTable;
    }

    public function indexAction()
    {
	    return array();
    }

    public function addAction()
    {
			if ($this->zfcUserAuthentication()->hasIdentity()) 
				{
					//echo 'loged in';
					$display_name = $this->zfcUserAuthentication()->getIdentity()->getDisplayname();
					$user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
					//echo $this->zfcUserAuthentication()->getIdentity()->getUsername();
				}
			else
				{
					$display_name = "";
					$user_id = 0;
				}
			$categories = $this->get_category_table()->get_all();
			$form = new PostForm();
			$form->get('submit')->setValue('Додати');
			$options;
			foreach($categories as $category)
				{
					$options[$category->id] = $category->name;
				}
			$form->get('category_id')->setValueOptions($options);    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = new Post();
            $form->setInputFilter($post->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $post->exchangeArray($form->getData());
                $this->getPostTable()->savePost($post);

                // Redirect to list of albums
                return $this->redirect()->toRoute('blog');
            }
        }
        return array('form' => $form, 'user_id' => $user_id);
    }
    
    public function editAction()
    {
			if ($this->zfcUserAuthentication()->hasIdentity()) 
				{
					//echo 'loged in';
					$display_name = $this->zfcUserAuthentication()->getIdentity()->getDisplayname();
					$user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
					//echo $this->zfcUserAuthentication()->getIdentity()->getUsername();
				}
			else
				{
					$display_name = "";
					$user_id = 0;
				}
			$categories = $this->get_category_table()->get_all();
			$id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('blog', array(
                'action' => 'add'
            ));
        }
        $post = $this->getPostTable()->getPost($id);
		  $options;
			foreach($categories as $category)
				{
					$options[$category->id] = $category->name;
				}
			
        $form  = new PostForm();
		  $form->get('category_id')->setValueOptions($options);    
        $form->bind($post);
        $form->get('submit')->setAttribute('value', 'Зберегти');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($post->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getPostTable()->savePost($post);

                // Redirect to list of albums
                return $this->redirect()->toRoute('blog');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
				'user_id' => $user_id
        );
    }
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('blog');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getPostTable()->deletePost($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('blog');
        }

        return array(
            'id'    => $id,
            'post' => $this->getPostTable()->getPost($id)
        );
    } 
	public function get_category_table()
            {
                if (!$this->categoryTable) {
                    $sm = $this->getServiceLocator();
                    $this->categoryTable = $sm->get('Application\Model\CategoryTable');
                }
                return $this->categoryTable;
            }
}