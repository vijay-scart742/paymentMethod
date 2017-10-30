<?php
/**
 * Copyright © 2015 Neo. All rights reserved.
 */

namespace Neo\Gocardless\Model\Resource;

class Items extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Model Initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('neo_gocardless_items', 'id');
    }
}
