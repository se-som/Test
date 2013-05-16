<?php
namespace Job\Model;
use Zend\Db\TableGateway\TableGateway;

class JobsTable
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

    public function getJobs($job_id)
    {
        $job_id  = (int) $job_id;
        $rowset = $this->tableGateway->select(array('job_id' => $job_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $job_id");
        }
        return $row;
    }

    public function saveJobs(Jobs $jobs,$lastid)
    {
        echo $lastid;
        $data = array(
            'jcat_id' => $lastid,
            'job_deadline' => $jobs->job_deadline,
            'job_description' => $jobs->job_description,
        );
        
        $job_id = (int)$jobs->job_id;
        if ($job_id == 0) {
            $this->tableGateway->insert($data);
            
        } else {
            echo 'dddddd';
            if ($this->getJobs($job_id)) {
                $this->tableGateway->update(array('job_id'=>$job_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteJobs($job_id)
    {
        $this->tableGateway->delete(array('job_id' => $job_id));
    } 
}