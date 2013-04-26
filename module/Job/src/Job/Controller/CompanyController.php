<?php
namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CompanyController extends AbstractActionController
{
    public function indexAction()
    {
        echo 'company page profile controller';
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
