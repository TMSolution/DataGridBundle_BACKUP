Add a virtual column
=======================

You can add a virtual or aggregate column (contact(a,b), max(a) etc.).
Always add a column with an alias to the grid.

## Usage

```php
<?php
use APY\DataGridBundle\Grid\Column\TextColumn;
...
$tableAlias = $grid->getSource()->getTableAlias();
       $queryBuilderFn = function ($queryBuilder) use($tableAlias) {
       ...
       $queryBuilder->select('a,b,concat(a,b) as virtualColumn');
       ...

      };
      $grid->getSource()->manipulateQuery($queryBuilderFn);
...
$column = new TextColumn(array('id' => 'virtualColumn', 'field'=>'virtualColumn' ,'title' => 'virtualColumn','isManualField'=>true, 'source' => $grid->getSource(), 'filterable' => true, 'sortable' => true));
$grid->addColumn($column,'asc');

```

**Note**: ...
