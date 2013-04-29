<?php
namespace Job\Model;
use Zend\Db\TableGateway\TableGateway;

class CategoryTable
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

    public function getCategory($cat_id)
    {
        $cat_id  = (int) $cat_id;
        $rowset = $this->tableGateway->select(array('cat_id' => $cat_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $cat_id");
        }
        return $row;
    }

    public function saveCategory(Category $category)
    {
        $data = array(
            'cat_name' => $category->cat_name,
        );
        
        $cat_id = (int)$category->cat_id;
        if ($cat_id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getCategory($cat_id)) {
                $this->tableGateway->update($data, array('cat_id' => $cat_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteCategory($cat_id)
    {
        $this->tableGateway->delete(array('cat_id' => $cat_id));
    }
}