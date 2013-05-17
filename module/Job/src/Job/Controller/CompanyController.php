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
use Job\Model\Company;
use Job\Form\CompanyForm;       

class CompanyController extends AbstractActionController
{
    protected $companyTable;
    // view category list in file index
    public function indexAction()
    {
        return new ViewModel(array(
            'companies' => $this->getCompanyTable()->fetchAll(),
        ));
    }
    // action add category  
    public function addAction()
    {
        $form = new CompanyForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest(); 
        if ($request->isPost()) {
            $company = new Company();
            
            $form->setInputFilter($company->getInputFilter());
            $form->setData($request->getPost());
           if ($form->isValid()) {
                $company->exchangeArray($form->getData());
                $this->getCompanyTable()->saveCompany($company);
                // Redirect to list of category again
                return $this->redirect()->toRoute('company');
            }
        }
        return array('form' => $form);
    }
    // action edit category
    public function editAction()
    {
        $com_id = (int) $this->params()->fromRoute('id', 1);
        echo $com_id;
        if (!$com_id) 
            {
                return $this->redirect()->toRoute('company', array(
                    'action' => 'add'
                ));
            }
         try {
            $company = $this->getcompanyTable()->getCompany($com_id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('company', array(
                'action' => 'index',
            ));
        }
        
       // $category = $this->getCategoryTable()->getCategory($cat_id);
        $form  = new CompanyForm();
        $form->bind($company);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($company->getInputFilter());
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getCompanyTable()->saveCompany($form->getData());
                // Redirect to list of category
                return $this->redirect()->toRoute('company');
            }
        }
        return array(
            'id' => $com_id,
            'form' => $form,
        );
    }
    // action delete category
    public function deleteAction()
    {
        $com_id = (int) $this->params()->fromRoute('id', 0);
        if (!$com_id) {
            return $this->redirect()->toRoute('company');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $com_id = (int) $request->getPost('com_id');
                $this->getCompanyTable()->deleteCompany($com_id);
            }
            // Redirect to list of category
            return $this->redirect()->toRoute('company');
        }
        return array(
            'com_id'    => $com_id,
            'company' => $this->getCompanyTable()->getCompany($com_id)
        );
    }
    public function getCompanyTable()
    {
        if (!$this->companyTable) {
            $sm = $this->getServiceLocator();
            $this->comanyTable = $sm->get('Job\Model\CompanyTable');
        }
        return $this->companyTable;
    }
   
   
}
