<?php
namespace Job\Model;

// Add these import statements
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Jobs implements InputFilterAwareInterface
{
    public $job_id;
//    public $jcat_id;
    public $job_deadline;
    public $job_description;
    protected $inputFilter;                       // <-- Add this variable

    public function exchangeArray($data)
    {
        $this->job_id   = (isset($data['job_id']))   ? $data['job_id']     : null;
 //       $this->jcat_id = (isset($data['jcat_id'])) ? $data['jcat_id'] : null;
        $this->job_deadline = (isset($data['job_deadline'])) ? $data['job_deadline'] : null;
        $this->job_description = (isset($data['job_description'])) ? $data['job_description'] : null;
    }

    // get mothod add new job 
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
                'name'     => 'job_id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
//            $inputFilter->add($factory->createInput(array(
//                'name'     => 'jcat_id',
//                'required' => true,
//                'filters'  => array(
//                    array('name' => 'StripTags'),
//                    array('name' => 'StringTrim'),
//                ),
//                'validators' => array(
//                    array(
//                        'name'    => 'StringLength',
//                        'options' => array(
//                            'encoding' => 'UTF-8',
//                            'min'      => 1,
//                            'max'      => 100,
//                        ),
//                    ),
//                ),
//            )));
           
              $inputFilter->add($factory->createInput(array(
                'name'     => 'job_deadline',
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
                'name'     => 'job_description',
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
	//get method edit job
	 public function getArrayCopy()
    {
        return get_object_vars($this);
    }

}