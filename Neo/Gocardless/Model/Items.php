<?php
/**
 * Copyright © 2015 Neo. All rights reserved.
 */

namespace Neo\Gocardless\Model;

class Items extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Neo\Gocardless\Model\Resource\Items');
    }
}
