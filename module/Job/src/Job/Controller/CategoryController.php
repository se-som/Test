<?php
namespace Job\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoryController extends AbstractActionController
{
    public function indexAction()
    {
        echo 'category page profile controller';
    }
    public function addAction()
    {
        echo 'add category controller';
    }
    public function editAction()
    {
        echo 'edit category controller';
    }
    public function deleteAction()
    {
        echo 'delete category controller';
    }
}


