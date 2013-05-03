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
use Job\Model\Jobcategory;
use Job\Model\Category;
use Job\Form\CategoryForm;
use Job\Form\JobcategoryForm;       

class JobcategoryController extends AbstractActionController
{
    protected $jobcategoryTable;
    protected $categoryTable;
    // view job category list in file index
    public function indexAction()
    {
        return new ViewModel(array(
                'dd' =>array(
                    'jobcategories' => $this->getJobcategoryTable()->fetchAll(),
                    'categories' => $this->getCategoryTable()->fetchAll(),
            )
        ));
    }
    // action add job category  
    public function addAction()
    {
        $form = new JobcategoryForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest(); 
        if ($request->isPost()) {
            $jobcategory = new Jobcategory();
            
            $form->setInputFilter($jobcategory->getInputFilter());
            $form->setData($request->getPost());
           if ($form->isValid()) {
                $jobcategory->exchangeArray($form->getData());
                $this->getJobcategoryTable()->saveJobcategory($jobcategory);
                // Redirect to list of job category again
                return $this->redirect()->toRoute('jobcategory');
            }
        }
        return array(
            'form' => $form,
            'dd' =>array(
                    'jobcategories' => $this->getJobcategoryTable()->fetchAll(),
                    'categories' => $this->getCategoryTable()->fetchAll(),
            )
            );
    }
    // action edit job category
    public function editAction()
    {
        $com_cat_id = (int) $this->params()->fromRoute('id', 1);
        if (!$com_cat_id) 
            {
                return $this->redirect()->toRoute('jobcategory', array(
                    'action' => 'add'
                ));
            }
         try {
            $jobcategory = $this->getjobcategoryTable()->getJobcategory($com_cat_id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('jobcategory', array(
                'action' => 'index',
            ));
        }
        
       // $category = $this->getCategoryTable()->getCategory($cat_id);
        $form  = new JobcategoryForm();
        $form->bind($jobcategory);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($jobcategory->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getJobcategoryTable()->saveJobcategory($form->getData());
                // Redirect to list of job category
                return $this->redirect()->toRoute('jobcategory');
            }
        }
        return array(
            'id' => $com_cat_id,
            'form' => $form,
            
        );
    }
    // action delete job category
    public function deleteAction()
    {
        $com_cat_id = (int) $this->params()->fromRoute('id', 0);
        if (!$com_cat_id) {
            return $this->redirect()->toRoute('jobcategory');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $com_cat_id = (int) $request->getPost('com_cat_id');
                $this->getJobcategoryTable()->deleteJobcategory($com_cat_id);
            }
            // Redirect to list of job category
            return $this->redirect()->toRoute('jobcategory');
        }
        return array(
            'com_cat_id'    => $com_cat_id,
            'jobcategory' => $this->getJobcategoryTable()->getJobcategory($com_cat_id)
        );
    }
    public function getJobcategoryTable()
    {
        if (!$this->jobcategoryTable) {
            $sm = $this->getServiceLocator();
            $this->jobcategoryTable = $sm->get('Job\Model\JobcategoryTable');
        }
        return $this->jobcategoryTable;
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
