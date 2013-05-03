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
use Job\Model\Jobs;    
use Job\Form\JobForm;

class JobController extends AbstractActionController
{
    protected $jobTable;
    // view job list in file index
    public function indexAction()
    {
        return new ViewModel(array(
            'jobs' => $this->getJobsTable()->fetchAll(),
        ));
    }
    // action add job  
    public function addAction()
    {
        $form = new JobForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest(); 
        if ($request->isPost()) {
            $jobs = new Jobs();
            
            $form->setInputFilter($jobs->getInputFilter());
            $form->setData($request->getPost());
           if ($form->isValid()) {
                $jobs->exchangeArray($form->getData());
                $this->getJobsTable()->saveJobs($jobs);
                // Redirect to list of job again
                return $this->redirect()->toRoute('jobs');
            }
        }
        return array('form' => $form);
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
   
   
}
