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
use Job\Model\Percentage; 
use Job\Model\Subject;
use Job\Model\Category;
use Job\Form\PercentageForm;       

class PercentageController extends AbstractActionController
{
    protected $subjectTable;
    protected $percentageTable;
    protected $categoryTable;

    // view Subject list in file index
    public function indexAction()
    {
        return new ViewModel(array(
            'percentages' => $this->getPercentageTable()->fetchAll(),
        ));
    }
    // action add Subject  
    public function addAction()
    {
        $form = new PercentageForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest(); 
        if ($request->isPost()) {
            $percentage = new Percentage();
           
            $form->setInputFilter($percentage->getInputFilter());
            $form->setData($request->getPost());
           if ($form->isValid()) {
               
                $percentage->exchangeArray($form->getData());
                $this->getPercentageTable()->savePercentage($percentage);
                // Redirect to list of Subject again
                return $this->redirect()->toRoute('percentage');
            }
        }
        return array(
            'form' => $form,
            'dd' =>array(
                'percentages' => $this->getPercentageTable()->fetchAll(),
                'subjects' => $this->getSubjectTable()->fetchAll(),
                'categories' => $this->getCategoryTable()->fetchAll(),
            )
            );
    }
    // action edit Subject
    public function editAction()
    {
        $per_id = (int) $this->params()->fromRoute('id', 1);
        if (!$per_id) 
            {
                return $this->redirect()->toRoute('percentage', array(
                    'action' => 'add'
                ));
            }
         try {
            $percentage = $this->getpercentageTable()->getPercentage($per_id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('percentage', array(
                'action' => 'index',
            ));
        }
        
       // $category = $this->getCategoryTable()->getCategory($cat_id);
        $form  = new PercentageForm();
        $form->bind($percentage);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($percentage->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getPercentageTable()->savePercentage($form->getData());
                // Redirect to list of Subject
                return $this->redirect()->toRoute('percentage');
            }
        }
        return array(
            'id' => $per_id,
            'form' => $form,
        );
    }
    // action delete Subject
    public function deleteAction()
    {
        $per_id = (int) $this->params()->fromRoute('id', 0);
        if (!$per_id) {
            return $this->redirect()->toRoute('percentage');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $per_id = (int) $request->getPost('per_id');
                $this->getPercentageTable()->deletePercentage($per_id);
            }
            // Redirect to list of Subject
            return $this->redirect()->toRoute('percentage');
        }
        return array(
            'per_id'    => $per_id,
            'percentage' => $this->getPercentageTable()->getPercentage($per_id)
        );
    }
    public function getPercentageTable()
    {
        if (!$this->percentageTable) {
            $sm = $this->getServiceLocator();
            $this->percentageTable = $sm->get('Job\Model\PercentageTable');
        }
        return $this->percentageTable;
    }  
   
    public function getSubjectTable()
    {
        if (!$this->subjectTable) {
            $sm = $this->getServiceLocator();
            $this->subjectTable = $sm->get('Job\Model\SubjectTable');
        }
        return $this->subjectTable;
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
