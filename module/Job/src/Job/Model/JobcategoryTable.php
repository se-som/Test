<?php
namespace Job\Model;
use Zend\Db\TableGateway\TableGateway;

class JobcategoryTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
       
        return $resultSet;
    }

    public function getJobcategory($com_cat_id)
    {
        $com_cat_id  = (int) $com_cat_id;
        $rowset = $this->tableGateway->select(array('com_cat_id' => $com_cat_id));
        $row = $rowset->current();
       
        if (!$row) {
            throw new \Exception("Could not find row $com_cat_id");
        }   
        return $row;  
       // print_r($row);
    }

    public function saveJobcategory(Jobcategory $jobcategory)
    {
        $data = array(
            'com_id' => $jobcategory->com_id,
            'cat_id' => $jobcategory->cat_id,
        );
        
        $com_cat_id = (int)$jobcategory->com_cat_id;
        if ($com_cat_id == 0) {
            $this->tableGateway->insert($data);
            $LastIdInsert = $this->tableGateway->getLastInsertValue();
            return $LastIdInsert;  
        } else {
            if ($this->getJobcategory($com_cat_id)) {
                $this->tableGateway->update($data, array('com_cat_id' => $com_cat_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteJobcategory($com_cat_id)
    {
        $this->tableGateway->delete(array('com_cat_id' => $com_cat_id));
    }
    
    public function getLastInsertid(){
       $lastid = $this->tableGateway->select();
      // if(!$lastid){
       foreach ($lastid as $id){
       // for get last row
       } 
       foreach ($id as $ee){
            //get id
            return $ee;
       }
      // }  else {
           
         //  throw new \Exception('Form id does not exist');
      // }
    }  
}