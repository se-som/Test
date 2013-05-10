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
use Job\Model\Jobs;   
use Job\Form\JobForm;
use Job\Form\JobcategoryForm;

class JobController extends AbstractActionController
{
    protected $jobTable;
    protected $jobcategoryTable;
    protected $categoryTable;
    protected $subjectTable;

    // view job list in file index
    public function indexAction()
    {
        return new ViewModel(array(
            'dd' =>array(
                    'jobs' => $this->getJobsTable()->fetchAll(),
                    'subjects' => $this->getSubjectTable()->fetchAll(),
                    'lastid' =>  $this->getJobcategoryTable()-> getLastInsertid(),
            )
        ));
    }
    // action add job  
    public function addAction()
    {
         $form = new JobForm();
        $form1 = new JobcategoryForm();
       
        
        $form1->get('submit')->setValue('Add');
        $form->get('submit')->setValue('Add');
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            
            $jobcategory = new Jobcategory();  
            $jobs = new Jobs();
            
            $form1->setInputFilter($jobcategory->getInputFilter());
            $form->setInputFilter($jobs->getInputFilter());
            
            $form->setData($request->getPost());
            $form1->setData($request->getPost());
            
           if ($form1->isValid()) {
               
                $jobcategory->exchangeArray($form1->getData());
                 $this->getJobcategoryTable()->saveJobcategory($jobcategory); 
               
                    if($form->isValid()){
                        $jobs->exchangeArray($form->getData());
                        $this->getJobsTable()->saveJobs($jobs);
                        
                        return $this->redirect()->toRoute('jobs');
                    }
           }
        }
        
        return array(
            'form' => $form,
            'dd' =>array(
                    'jobs' => $this->getJobsTable()->fetchAll(),
                    'categories' => $this->getCategoryTable()->fetchAll(),
            )
            );
    }
    // action edit job
    public function editAction()
    {
        $job_id = (int) $this->params()->fromRoute('id', 1);
        if (!$job_id) 
            {
                return $this->redirect()->toRoute('jobs', array(
                    'action' => 'add'
                ));
            }
         try {
            $jobs = $this->getjobsTable()->getJobs($job_id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('jobs', array(
                'action' => 'index',
            ));
        }
        
        $form  = new JobForm();
        $form->bind($jobs);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($jobs->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getJobsTable()->saveJobs($form->getData());
                // Redirect to list of job
                return $this->redirect()->toRoute('jobs');
            }
        }
        return array(
            'id' => $job_id,
            'form' => $form,
            );
    }
    // action delete job
    public function deleteAction()
    {
        $job_id = (int) $this->params()->fromRoute('id', 0);
        if (!$job_id) {
            return $this->redirect()->toRoute('job');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $job_id = (int) $request->getPost('job_id');
                $this->getJobsTable()->deleteJobs($job_id);
            }
            // Redirect to list of job
            return $this->redirect()->toRoute('jobs');
        }
        return array(
            'job_id'    => $job_id,
            'jobs' => $this->getJobsTable()->getJobs($job_id)
        );
    }
    public function getJobsTable()
    {
        if (!$this->jobTable) {
            $sm = $this->getServiceLocator();
            $this->jobTable = $sm->get('Job\Model\JobsTable');
        }
        return $this->jobTable;
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
     public function getSubjectTable()
    {
        if (!$this->subjectTable) {
            $sm = $this->getServiceLocator();
            $this->subjectTable = $sm->get('Job\Model\SubjectTable');
        }
        return $this->subjectTable;
    }
   
}
