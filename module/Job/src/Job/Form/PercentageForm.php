<?php
namespace Job\Form;
use Zend\Form\Form;

class PercentageForm extends Form
{
    public function __construct($name = Null )
    {
        // we want to ignore the name passed
        parent::__construct('percentage');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'per_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
		$this->add(array(
            'name' => 'per_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),             
        ));
        
         $this->add(array(
            'name' => 'sub_id',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'subject id',
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
