<?php
namespace Job\Form;
use Zend\Form\Form;

class JobForm extends Form
{
    public function __construct($name = Null )
    {
        // we want to ignore the name passed
        parent::__construct('job');
        $this->setAttribute('method', 'post');
        
        
        
        
        $this->add(array(
            'name' => 'job_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        
	$this->add(array(
            'name' => 'job_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),             
        ));
        
        $this->add(array(
            'name' => 'jcat_id',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'job category id',
                'class' => 'input-xlarge'
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
            'name' => 'job_deadline',
            'type' => 'text',
            'attributes' => array(
                'class' => 'datepicker',
                'min' => '2012-01-01',
                'max' => '2020-01-01',
                'step' => '1'
	),   
        ));
        
        $this->add(array(
            'name' => 'job_description',
            'attributes' => array(
                'type'  => 'textarea',
                'placeholder' => 'job description',
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
