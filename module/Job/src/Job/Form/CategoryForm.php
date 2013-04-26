<?php
namespace Job\Form;
use Zend\Form\Form;

class CategoryForm extends Form
{
    public function __construct($name = Null )
    {
        // we want to ignore the name passed
        parent::__construct('category');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'cat_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'cat_name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'category',
                'class' => 'input-xlarge'
            ),             
        ));
     		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-success',
            ),
        ));
    }
} 
