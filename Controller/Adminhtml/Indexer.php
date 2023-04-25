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

namespace Ultraplugin\BackendReindex\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Indexer\IndexerRegistry;

abstract class Indexer extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ultraplugin_BackendReindex::reindex';

    /**
     * @var IndexerRegistry
     */
    protected $indexerRegistry;

    /**
     * Indexer constructor
     *
     * @param Context $context
     * @param IndexerRegistry $indexerRegistry
     */
    public function __construct(
        Context $context,
        IndexerRegistry $indexerRegistry
    ) {
        $this->indexerRegistry = $indexerRegistry;
        parent::__construct($context);
    }
}
