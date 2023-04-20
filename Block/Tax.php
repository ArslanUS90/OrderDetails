<?php

namespace ArslanFarrukh\OrderDetails\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Tax\Helper\Data;
use Magento\Tax\Model\Config;

class Tax extends \Magento\Tax\Block\Sales\Order\Tax
{
    /**
     * Tax helper
     * @var Data
     */
    protected $helper;

    /**
     * Tax Constructor
     * @param Context $context
     * @param Config $taxConfig
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Config $taxConfig,
        Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;
        parent::__construct($context, $taxConfig, $data);
    }

    /**
     * Get Helper Tax
     * @return Data
     */
    public function getHelper()
    {
        return $this->helper;
    }
}
