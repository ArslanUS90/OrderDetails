<?php

namespace ArslanFarrukh\OrderDetails\Block;

use ArslanFarrukh\OrderDetails\Helper\Data;
use Magento\Checkout\Model\Session;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\Order\Address\Renderer;
use Magento\Sales\Model\OrderFactory;

class Details extends \Magento\Sales\Block\Order\Totals
{
    /**
     * Checkout Session
     * @var Session
     */
    protected $checkoutSession;

    /**
     * Customer Session
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * Sales Factory
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * Order Address
     * @var Renderer
     */
    protected $render;

    /**
     * Bss Helper Data
     * @var Data
     */
    protected $helper;

    /**
     * Pricing Helper Data
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    protected $formatPrice;

    /**
     * Order Details Constructor
     * @param Session $checkoutSession
     * @param \Magento\Customer\Model\Session $customerSession
     * @param OrderFactory $orderFactory
     * @param Context $context
     * @param Data $helper
     * @param Renderer $render
     * @param Registry $registry
     * @param \Magento\Framework\Pricing\Helper\Data $formatPrice
     * @param array $data
     */
    public function __construct(
        Session                                $checkoutSession,
        \Magento\Customer\Model\Session        $customerSession,
        OrderFactory                           $orderFactory,
        Context                                $context,
        Data                                   $helper,
        Renderer                               $render,
        Registry                               $registry,
        \Magento\Framework\Pricing\Helper\Data $formatPrice,
        array                                  $data = []
    ) {
        parent::__construct($context, $registry, $data);
        $this->checkoutSession = $checkoutSession;
        $this->customerSession = $customerSession;
        $this->orderFactory = $orderFactory;
        $this->render = $render;
        $this->helper = $helper;
        $this->formatPrice = $formatPrice;
    }

    /**
     * Get last order id
     * @return string
     */
    public function getOrder()
    {
        return  $this->_order = $this->orderFactory->create()->loadByIncrementId(
            $this->checkoutSession->getLastRealOrderId());
    }

    /**
     * Get Enable|Disable
     * @return bool
     */
    public function isEnableDetails()
    {
        return $this->helper->isEnable();
    }

    /**
     * Get Thanks Messeger
     * @return string
     */
    public function getThankMessegerDetails()
    {
        return $this->helper->getThankMesseger();
    }

    /**
     * Get Enable|Disable Order Status
     * @return bool
     */
    public function isEnableOrderStatusDetails()
    {
        return $this->helper->isEnableOrderStatus();
    }

    /**
     * Get Text Before Order
     * @return string
     */
    public function getBeforeTextDetails()
    {
        return $this->helper->getBeforeText();
    }

    /**
     * Get Text After Order
     * @return string
     */
    public function getAfterTextDetails()
    {
        return $this->helper->getAfterText();
    }

    /**
     * Get Enable|Disable Shipping Address
     * @return bool
     */
    public function isEnableShippingAddressDetails()
    {
        return $this->helper->isEnableShippingAddress();
    }

    /**
     * Get Enable|Disable Shipping Method
     * @return bool
     */
    public function isEnableShippingMethodDetails()
    {
        return $this->helper->isEnableShippingMethod();
    }

    /**
     * Get Enable|Disable BiLLing Address
     * @return bool
     */
    public function isEnableBillingAddressDetails()
    {
        return $this->helper->isEnableBillingAddress();
    }

    /**
     * Get Enable|Disable Payment Method
     * @return bool
     */
    public function isEnablePaymentMethodDetails()
    {
        return $this->helper->isEnablePaymentMethod();
    }

    /**
     * Get Enable|Disable Product Details
     * @return bool
     */
    public function isEnableOrderProductDetails()
    {
        return $this->helper->isEnableOrderProduct();
    }

    /**
     * Get Thank Messeger Size
     * @return string
     */
    public function getThankMessegerSizeDetails()
    {
        return $this->helper->getThankMessegerSize();
    }

    /**
     * Get Text Before Size
     * @return string
     */
    public function getBeforeTextSizeDetails()
    {
        return $this->helper->getBeforeTextSize();
    }

    /**
     * Get Text After Size
     * @return string
     */
    public function getAfterTextSizeDetails()
    {
        return $this->helper->getAfterTextSize();
    }

    /**
     * Get Thank Messeger Color
     * @return string
     */
    public function getThankMessegerColorDetails()
    {
        return $this->helper->getThankMessegerColor();
    }

    /**
     * Get Text Before Color
     * @return string
     */
    public function getBeforeTextColorDetails()
    {
        return $this->helper->getBeforeTextColor();
    }

    /**
     * Get Text After Color
     * @return string
     */
    public function getAfterTextColorDetails()
    {
        return $this->helper->getAfterTextColor();
    }

    /**
     * Get Customer Id
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerSession->getCustomer()->getId();
    }

    /**
     * Render Block
     * @return string
     */
    public function getAdditionalInfoHtml()
    {
        return $this->_layout->renderElement('order.success.additional.info');
    }

    /**
     * Format Price
     *
     * @param float $value
     * @return float
     */
    public function formatPrice($value)
    {
        return $this->formatPrice->currency($value, true, false);
    }

    /**
     * Get Re-Order
     * @return string
     */
    public function getReorder()
    {
        $order = $this->getOrder();
        $orderID = $order->getId();
        $reorder = $this->getBaseUrl().'sales/order/view/order_id/'.$orderID;
        return $reorder;
    }

    /**
     * Get Print Order
     * @return string
     */
    public function getPrint()
    {
        $order = $this->getOrder();
        $orderID = $order->getId();
        $print = $this->getBaseUrl().'sales/order/print/order_id/'.$orderID;
        return $print;
    }

    /**
     * Can View Re-Order
     * @return bool
     */
    public function canViewReorder()
    {
        if ($this->helper->isEnableReOrderLink() && $this->helper->isEnableReOrder() && $this->getCustomerId()) {
            return true;
        }
            return false;
    }

    /**
     * Can View Print Order
     * @return bool
     */
    public function canViewPrint()
    {
        if ($this->helper->isEnablePrintOrderLink() && $this->getCustomerId()) {
            return true;
        }
            return false;
    }

    /**
     * Format Shipping Address
     * @return string
     */
    public function formatShipping()
    {
        $order = $this->getOrder();
        if ($order->getShippingAddress()) {
            return $this->render->format($order->getShippingAddress(), 'html');
        }
            return false;
    }

    /**
     * Format Billing Address
     * @return string
     */
    public function formatBilling()
    {
            $order = $this->getOrder();
            return $this->render->format($order->getBillingAddress(), 'html');
    }

    /**
     * Format date
     *
     * @param string $date
     * @param string $format
     * @param bool $showTime
     * @param string $timezone
     * @param string $pattern
     * @return string
     */
    public function formatDate(
        $date = null,
        $format = \IntlDateFormatter::SHORT,
        $showTime = false,
        $timezone = null,
        $pattern = 'd MMM Y'
    ) {

            $date = $date instanceof \DateTimeInterface;
            return $this->_localeDate->formatDateTime(
                $date,
                $format,
                $showTime ? $format : \IntlDateFormatter::NONE,
                null,
                $timezone,
                $pattern
            );
    }

    /**
     * Return Opptions Configurable Product
     *
     * @param object $item
     * @return array
     */
    public function getItemOptions($item)
    {
        $result = [];
        $option = $item->getProductOptions();
        if ($option) {
            if (isset($option['options'])) {
                    $result = array_merge($result, $option['options']);
            }
            if (isset($option['additional_options'])) {
                    $result = array_merge($result, $option['additional_options']);
            }
            if (isset($option['attributes_info'])) {
                    $result = array_merge($result, $option['attributes_info']);
            }
        }
        return $result;
    }

    /**
     * Return Opptions Bundle Product
     *
     * @param object $item
     * @return array
     */
    public function getBundleItemOptions($item)
    {
        $result = [];
        $option = $item->getProductOptions();
        if ($option) {
            if (isset($option['bundle_options'])) {
                $result = array_merge($result, $option['bundle_options']);
            }
        }
        return $result;
    }
}
