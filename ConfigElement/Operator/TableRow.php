<?php
/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @category   Pimcore
 * @package    EcommerceFramework
 * @copyright  Copyright (c) 2009-2016 pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PEL
 */


namespace OutputDataConfigToolkitBundle\ConfigElement\Operator;
 
class TableRow extends AbstractOperator {

    protected $headline;

    public function __construct($config, $context = null) {
        parent::__construct($config, $context);

        $this->headline = $config->headline;
    }

    public function getLabeledValue($object) {
        $value = new \stdClass();

        $isEmpty = true;
        $childs = $this->getChilds();

        foreach($childs as $c) {

            $col = $c->getLabeledValue($object);
            if(!empty($col) && (!$col->empty && !($c instanceof \Elements\OutputDataConfigToolkit\ConfigElement\Operator\Text))) {
                $isEmpty = false;
            }
            $valueArray[] = $c->getLabeledValue($object);
        }

        $value->value = $valueArray;
        $value->headline = $this->headline;


        if($isEmpty) {
            $value->empty = true;
        } else {
            $value->empty = false;
        }

        return $value;
    }
}