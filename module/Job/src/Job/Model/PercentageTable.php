<?php
namespace Job\Model;
use Zend\Db\TableGateway\TableGateway;

class PercentageTable
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

    public function getPercentage($per_id)
    {
        $per_id  = (int) $per_id;
        $rowset = $this->tableGateway->select(array('per_id' => $per_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $per_id");
        }
        return $row;
    }

    public function savePercentage(Percentage $percentage)
    {
        $data = array(
            'sub_id' => $percentage->sub_id,
            'com_id' => $percentage->com_id,
            'percentage' => $percentage->percentage,
        );
        
        $per_id = (int)$percentage->per_id;
        if ($per_id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getPercentage($per_id)) {
                $this->tableGateway->update($data, array('per_id' => $per_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deletePercentage($per_id)
    {
        $this->tableGateway->delete(array('per_id' => $per_id));
    }
}