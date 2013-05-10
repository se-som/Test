<?php
namespace Job\Model;

// Add these import statements
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Percentage implements InputFilterAwareInterface
{
    public $per_id;
    public $sub_id;
    public $com_id;
    public $percentage;
    protected $inputFilter;                       // <-- Add this variable

    public function exchangeArray($data)
    {
        $this->per_id   = (isset($data['per_id']))   ? $data['per_id'] : null;
        $this->sub_id   = (isset($data['sub_id']))   ? $data['sub_id'] : null;
        $this->com_id = (isset($data['com_id'])) ? $data['com_id'] : null;
         $this->percentage   = (isset($data['percentage']))   ? $data['percentage'] : null;
    }

    // get mothod add new subject
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
            $inputFilter->add($factory->createInput(array(
                'name'     => 'per_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'sub_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
             $inputFilter->add($factory->createInput(array(
                'name'     => 'com_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'percentage',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
	//get method edit subject
	 public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}