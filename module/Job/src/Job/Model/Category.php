<?php
namespace Job\Model;

// Add these import statements
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Category implements InputFilterAwareInterface
{
    public $cat_id;
    public $cat_name;
    protected $inputFilter;                       // <-- Add this variable

    public function exchangeArray($data)
    {
        $this->cat_id   = (isset($data['cat_id']))   ? $data['cat_id']     : null;
        $this->cat_name = (isset($data['cat_name'])) ? $data['cat_name'] : null;
    }

    // get mothod add new category
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
                'name'     => 'cat_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'cat_name',
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
	//get method edit category
	 public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}