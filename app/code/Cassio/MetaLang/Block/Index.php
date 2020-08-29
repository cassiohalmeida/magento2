<?php

namespace Cassio\MetaLang\Block;

use Magento\Cms\Model\Page;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

class Index extends Template
{
    protected $_page;
    protected $_storeManager;
    protected $_scopeConfig;

    public function __construct(
        Context $context,
        Page $page,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        $data
    )
    {
        parent::__construct($context, $data);
        $this->_page = $page;
        $this->_storeManager = $storeManager;
        $this->_scopeConfig = $scopeConfig;
    }

//    public function itsATestFunction()
//    {
//        var_dump($this->getStores());
//        var_dump($this->_storeManager->getStore(1)->getName());
//        var_dump($this->_storeManager->getStore(1)->getBaseUrl());
//        var_dump($this->_storeManager->getStore(1)->getConfig('general/locale/code'));
//        return true;
//    }

    /**
     * If the page is used in more than one store.
     * @return bool
     */
    public function isUsedInMultipleStores() {
        return count($this->getStores()) > 1;
    }

    /**
     * @param $storeId
     * @return string teh store locale code
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStoreLocaleCode($storeId) {
        return $this->_storeManager->getStore($storeId)->getConfig('general/locale/code');
    }

    /**
     * @param $storeId
     * @return string the store base URL
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStoreBaseUrl($storeId) {
        return $this->_storeManager->getStore($storeId)->getBaseUrl();
    }

    /**
     * @return array
     */
    public function getStores()
    {
        return $this->_page->getStores();
    }
}
