<?php
namespace Job\Form;
use Zend\Form\Form;

class CompanyForm extends Form
{
    public function __construct($name = Null )
    {
        // we want to ignore the name passed
        parent::__construct('addcompany');
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'com_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        
	$this->add(array(
            'name' => 'com_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),             
        ));
        $this->add(array(
            'name' => 'user_id',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'user id',
                'class' => 'input-xlarge'
            ),             
        ));
        $this->add(array(
            'name' => 'approve',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'approve',
                'class' => 'input-xlarge'
            ),             
        ));
         $this->add(array(
            'name' => 'com_name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'company name',
                'class' => 'input-xlarge'
            ),             
        ));
        $this->add(array(
            'name' => 'com_location',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'company location',
                'class' => 'input-xlarge'
            ),             
        ));
        
        $this->add(array(
            'name' => 'com_phone',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'company phone',
                'class' => 'input-xlarge'
            ),             
        ));
        $this->add(array(
            'name' => 'com_email',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'company email',
                'class' => 'input-xlarge'
            ),             
        ));
        $this->add(array(
            'name' => 'com_web',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'compay web sit',
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
