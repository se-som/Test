<?php
namespace Job\Form;
use Zend\Form\Form;

class JobcategoryForm extends Form
{
    public function __construct($name = Null )
    {
        // we want to ignore the name passed
        parent::__construct('jobcategory');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'com_cat_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
		$this->add(array(
            'name' => 'com_cat_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),             
        ));
        $this->add(array(
            'name' => 'com_id',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'company id',
                'class' => 'input-xlarge'
            ),             
        ));
        $this->add(array(
            'name' => 'cat_id',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'category id',
                'class' => 'input-xlarge'
            ),             
        ));
     		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'cat_id' => 'submitbutton',
                'class' => 'btn btn-success',
            ),
        ));
    }
} 
