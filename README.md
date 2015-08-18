# TMSolution/DataGridBundle manual

>by Damian Piela <damian.piela@tmsolution.pl>

---


### Description

DataGridBundle is a set of tools for presenting entity data in a coherent and legible form. 
Additionally, it allows you to make use of new functionalities by adding supplementary buttons, or to display adjustable amount of data acoording to predefined values.


### Installation

DataGridBundle uses *apy/datagrid-bundle*, so in order to install the bundle, add: 

```
//composer require

"tmsolution/model-bundle":"1.*",
"apy/datagrid-bundle": "2.*"
```

to your project's `composer.json` file. Later, enable your bundle in the app's kernel:

```
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new APY\DataGridBundle\APYDataGridBundle(),
        new Core\ModelBundle\CoreModelBundle(),
        new TMSolution\DataGridBundle\TMSolutionDataGridBundle()
    );
}
```

