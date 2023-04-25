<?php
/**
 * UltraPlugin
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the ultraplugin.com license that is
 * available through the world-wide-web at this URL:
 * https://ultraplugin.com/end-user-license-agreement
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    UltraPlugin
 * @package     Ultraplugin_BackendReindex
 * @copyright   Copyright (c) UltraPlugin (https://ultraplugin.com/)
 * @license     https://ultraplugin.com/end-user-license-agreement
 */

namespace Ultraplugin\BackendReindex\Controller\Adminhtml\Indexer;

use Ultraplugin\BackendReindex\Controller\Adminhtml\Indexer;

class Reindex extends Indexer
{
    public function execute()
    {
        $indexerId = $this->getRequest()->getParam('id');
        $indexer = $this->indexerRegistry->get($indexerId);
        if ($indexer->getId()) {
            try {
                $indexer->reindexAll();
                $this->messageManager->addSuccessMessage(__('%1 index was reindex.', $indexer->getTitle()));
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e->getMessage());
            }
        } else {
            $this->messageManager->addErrorMessage(__('Something went wrong'));
        }
        $this->_redirect('indexer/indexer/list');
    }
}
