<?php
/**
 * Copyright © 2015 Neo. All rights reserved.
 */

namespace Neo\Gocardless\Model\Resource\Items;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Neo\Gocardless\Model\Items', 'Neo\Gocardless\Model\Resource\Items');
    }
}
