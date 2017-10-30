<?php
/**
 * Copyright © 2015 Neo. All rights reserved.
 */

namespace Neo\Gocardless\Controller\Adminhtml\Items;

class Index extends \Neo\Gocardless\Controller\Adminhtml\Items
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Neo_Gocardless::gocardless');
        $resultPage->getConfig()->getTitle()->prepend(__('Neo Items'));
        $resultPage->addBreadcrumb(__('Neo'), __('Neo'));
        $resultPage->addBreadcrumb(__('Items'), __('Items'));
        return $resultPage;
    }
}
