<?php
 // module/Job/src/Job/Controller/JobController.php:
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Job\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Job\Model\Category;        
use Job\Form\CategoryForm;       

class CategoryController extends AbstractActionController
{
    protected $categoryTable;
    // view category list in file index
    public function indexAction()
    {
        return new ViewModel(array(
            'categories' => $this->getCategoryTable()->fetchAll(),
        ));
    }
    // action add category  
    public function addAction()
    {
        $form = new CategoryForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest(); 
        if ($request->isPost()) {
            $category = new Category();
            
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());
           if ($form->isValid()) {
                $category->exchangeArray($form->getData());
                $this->getCategoryTable()->saveCategory($category);
                // Redirect to list of category again
                return $this->redirect()->toRoute('category');
            }
        }
        return array('form' => $form);
    }
    // action edit category
    public function editAction()
    {
        $cat_id = (int) $this->params()->fromRoute('id', 1);
        if (!$cat_id) 
            {
                return $this->redirect()->toRoute('category', array(
                    'action' => 'add'
                ));
            }
         try {
            $category = $this->getcategoryTable()->getCategory($cat_id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('category', array(
                'action' => 'index',
            ));
        }
        
       // $category = $this->getCategoryTable()->getCategory($cat_id);
        $form  = new CategoryForm();
        $form->bind($category);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getCategoryTable()->saveCategory($form->getData());
                // Redirect to list of category
                return $this->redirect()->toRoute('category');
            }
        }
        return array(
            'id' => $cat_id,
            'form' => $form,
        );
    }
    // action delete category
    public function deleteAction()
    {
        $cat_id = (int) $this->params()->fromRoute('id', 0);
        if (!$cat_id) {
            return $this->redirect()->toRoute('category');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $cat_id = (int) $request->getPost('cat_id');
                $this->getCategoryTable()->deleteCategory($cat_id);
            }
            // Redirect to list of category
            return $this->redirect()->toRoute('category');
        }
        return array(
            'cat_id'    => $cat_id,
            'category' => $this->getCategoryTable()->getCategory($cat_id)
        );
    }
    public function getCategoryTable()
    {
        if (!$this->categoryTable) {
            $sm = $this->getServiceLocator();
            $this->categoryTable = $sm->get('Job\Model\CategoryTable');
        }
        return $this->categoryTable;
    }
   
   
}
