<?php
namespace Job\Model;
use Zend\Db\TableGateway\TableGateway;

class CompanyTable
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

    public function getCompany($com_id)
    {
        $com_id  = (int) $com_id;
        $rowset = $this->tableGateway->select(array('com_id' => $com_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $com_id");
        }
        return $row;
    }

    public function saveCompany(Company $company)
    {
        $data = array(
            'user_id' => $company->user_id,
            'approve' => $company->approve,
            'com_name' => $company->com_name,
            'com_phone'  => $company->com_phone,
            'com_email' => $company->com_email,
            'com_web' => $company->com_web,
        );

        $com_id = (int)$company->com_id;
        if ($com_id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getCompany($com_id)) {
                $this->tableGateway->update($data, array('com_id' => $com_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteCompany($com_id)
    {
        $this->tableGateway->delete(array('com_id' => $com_id));
    }
}
