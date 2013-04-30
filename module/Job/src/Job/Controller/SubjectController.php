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
use Job\Model\Subject;        
use Job\Form\SubjectForm;       

class SubjectController extends AbstractActionController
{
    protected $subjectTable;
    // view Subject list in file index
    public function indexAction()
    {
        return new ViewModel(array(
            'subjects' => $this->getSubjectTable()->fetchAll(),
        ));
    }
    // action add Subject  
    public function addAction()
    {
        $form = new SubjectForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest(); 
        if ($request->isPost()) {
            $subject = new Subject();
            
            $form->setInputFilter($subject->getInputFilter());
            $form->setData($request->getPost());
           if ($form->isValid()) {
                $subject->exchangeArray($form->getData());
                $this->getSubjectTable()->saveSubject($subject);
                // Redirect to list of Subject again
                return $this->redirect()->toRoute('subject');
            }
        }
        return array('form' => $form);
    }
    // action edit Subject
    public function editAction()
    {
        $sub_id = (int) $this->params()->fromRoute('id', 1);
        if (!$sub_id) 
            {
                return $this->redirect()->toRoute('subject', array(
                    'action' => 'add'
                ));
            }
         try {
            $subject = $this->getsubjectTable()->getSubject($sub_id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('subject', array(
                'action' => 'index',
            ));
        }
        
       // $category = $this->getCategoryTable()->getCategory($cat_id);
        $form  = new SubjectForm();
        $form->bind($subject);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($subject->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getSubjectTable()->saveSubject($form->getData());
                // Redirect to list of Subject
                return $this->redirect()->toRoute('subject');
            }
        }
        return array(
            'id' => $sub_id,
            'form' => $form,
        );
    }
    // action delete Subject
    public function deleteAction()
    {
        $sub_id = (int) $this->params()->fromRoute('id', 0);
        if (!$sub_id) {
            return $this->redirect()->toRoute('subject');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $sub_id = (int) $request->getPost('sub_id');
                $this->getSubjectTable()->deleteSubject($sub_id);
            }
            // Redirect to list of Subject
            return $this->redirect()->toRoute('subject');
        }
        return array(
            'sub_id'    => $sub_id,
            'subject' => $this->getSubjectTable()->getSubject($sub_id)
        );
    }
    public function getSubjectTable()
    {
        if (!$this->subjectTable) {
            $sm = $this->getServiceLocator();
            $this->subjectTable = $sm->get('Job\Model\SubjectTable');
        }
        return $this->subjectTable;
    }  
}
