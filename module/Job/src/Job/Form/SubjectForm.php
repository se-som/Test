<?php
namespace Job\Form;
use Zend\Form\Form;

class SubjectForm extends Form
{
    public function __construct($name = Null )
    {
        // we want to ignore the name passed
        parent::__construct('subject');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'sub_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
		$this->add(array(
            'name' => 'sub_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),             
        ));
        $this->add(array(
            'name' => 'com_cat_id',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'com category id',
                'class' => 'input-xlarge'
            ),             
        ));
        $this->add(array(
            'name' => 'sub_name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'subject',
                'class' => 'input-xlarge'
            ),             
        ));
        $this->add(array(
            'name' => 'percentage',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'percentage',
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
