<?php
namespace Job\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Job\Model\Company;  
use Job\Model\CompanyTable;

class CompanyController extends AbstractActionController
{
    protected $companyTable;
    public function indexAction()
    {
        echo 'company page profile controller';
        return new ViewModel(array(
            'company' => $this->getCompanyTable()->fetchAll(),
        ));
        
    }
    public function addAction()
    {
        echo 'add company controller';
    }
    public function editAction()
    {
        echo 'edit company controller';
    }
    public function deleteAction()
    {
        echo 'delete company controller';
    }
   
}
