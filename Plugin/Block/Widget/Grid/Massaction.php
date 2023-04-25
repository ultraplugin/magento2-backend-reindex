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

namespace Ultraplugin\BackendReindex\Plugin\Block\Widget\Grid;

use Magento\Backend\Block\Widget\Grid\Massaction as MassactionParent;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Massaction
{
    protected const XML_PATH_MODULE_ENABLE = 'backendreindex/general/enabled';

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Remove index item if extension disabled
     *
     * @param MassactionParent $subject
     * @param string $itemId
     * @param array|DataObject $item
     * @return string[]|void
     * @throws NoSuchEntityException
     */
    public function beforeAddItem(
        MassactionParent $subject,
        $itemId,
        $item
    ) {
        if (($itemId == 'mp_reindex' || $itemId == 'mp_reset') && !$this->isEnabled()) {
            return ['',''];
        }
    }

    /**
     * Check is enabled
     *
     * @return bool
     * @throws NoSuchEntityException
     */
    public function isEnabled()
    {
        $store = $this->storeManager->getStore();
        return $this->scopeConfig->getValue(
            self::XML_PATH_MODULE_ENABLE,
            ScopeInterface::SCOPE_STORE,
            $store->getId()
        );
    }
}
