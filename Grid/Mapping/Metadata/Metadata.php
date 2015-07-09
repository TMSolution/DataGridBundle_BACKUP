<?php

/*
 * This file is part of the DataGridBundle.
 *
 * (c) Abhoryo <abhoryo@free.fr>
 * (c) Stanislav Turza
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TMSolution\DataGridBundle\Grid\Mapping\Metadata;

use APY\DataGridBundle\Grid\Mapping\Metadata\Metadata as BaseMetadata;
use TMSolution\DataGridBundle\Grid\Column\Column;

class Metadata extends BaseMetadata {

    protected $model = null;

    public function __construct($model) {
        $this->model = $model;
    }
    
     protected $name;
    protected $fields;
    protected $fieldsMappings;
    protected $groupBy;

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setFieldsMappings($fieldsMappings)
    {
        $this->fieldsMappings = $fieldsMappings;

        return $this;
    }

    public function hasFieldMapping($field)
    {
        return isset($this->fieldsMappings[$field]);
    }

    public function getFieldMapping($field)
    {
        return $this->fieldsMappings[$field];
    }

    public function getFieldMappingType($field)
    {
        return (isset($this->fieldsMappings[$field]['type'])) ? $this->fieldsMappings[$field]['type'] : 'text';
    }

    public function setGroupBy($groupBy)
    {
        $this->groupBy = $groupBy;

        return $this;
    }

    public function getGroupBy()
    {
        return $this->groupBy;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function addMapping($associatedField, $field, $type = "text") {
        
        if ($this->model->hasAssociatedObjectField($associatedField, $field)) {
        
            $this->fields[] = $fieldName = $associatedField . "." . $field;
            $this->fieldsMappings[$fieldName] = array("title" => $fieldName, "source" => true, "field" => $fieldName, "id" => $fieldName, "type" => $type, 'associated' => true);
        }
    }

    public function addField() {
        
    }

    public function removeField() {
        
    }

    public function addFieldsMapping() {
        
    }

    public function removeFieldMapping() {
        
    }

    public function getColumnsFromMapping($columnExtensions) {
        $columns = new \SplObjectStorage();

        foreach ($this->getFields() as $value) {
            $params = $this->getFieldMapping($value);
            

            $type = $this->getFieldMappingType($value);
            
          
            /** todo move available extensions from columns */
            if ($columnExtensions->hasExtensionForColumnType($type)) {
                $column = clone $columnExtensions->getExtensionForColumnType($type);
                $column->__initialize($params);
                if($this->fieldsMappings[$value]["associated"]==true){
                    
                    $column->setDefaultOperator(Column::OPERATOR_EQ);
                }
                
                
                
                $columns->attach($column);
            } else {
                throw new \Exception(sprintf("No suitable Column Extension found for column type: %s", $type));
            }
        }

        return $columns;
    }

}
