<?php
/**
 * Copyright © 2015 Neo. All rights reserved.
 */

namespace Neo\Gocardless\Controller\Adminhtml\Items;

class NewAction extends \Neo\Gocardless\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
