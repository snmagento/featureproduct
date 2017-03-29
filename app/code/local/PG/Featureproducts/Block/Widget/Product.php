<?php

class PG_Featureproducts_Block_Widget_Product extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('pg/widget/product.phtml');

    }

    public function displayImage()
    {
        return $this->getData('product_image');
    }

    public function displayPrice()
    {
        return $this->getData('product_price');
    }

    private function displayPageSize()
    {
        return $this->getData('display_number');
    }

    private function getAttributes()
    {
        $attributes = array('product_url');
        if ($this->displayImage()) {
            $attributes[] = 'small_image';
        }
        if ($this->displayPrice()) {
            $attributes[] = 'price';
        }
        return $attributes;
    }

    public function getProductCollection()
    {
        $productsCollection = Mage::getModel('catalog/product')->getCollection();
        $productsCollection->addAttributeToFilter('use_in_featured_widget', 1);
        $productsCollection->addAttributeToSelect($this->getAttributes());
        $productsCollection->setPageSize($this->displayPageSize());
        return $productsCollection;
    }

    public function getPriceHtml($product)
    {
        return Mage::helper('core')->currency($product->getPrice());
    }

    public function getAddToCartUrl($product, $additional = array())
    {
        if (!$product->getTypeInstance(true)->hasRequiredOptions($product)) {
            return $this->helper('checkout/cart')->getAddUrl($product, $additional);
        }
        $additional = array_merge(
            $additional,
            array(Mage_Core_Model_Url::FORM_KEY => $this->_getSingletonModel('core/session')->getFormKey())
        );
        if (!isset($additional['_escape'])) {
            $additional['_escape'] = true;
        }
        if (!isset($additional['_query'])) {
            $additional['_query'] = array();
        }
        $additional['_query']['options'] = 'cart';
        return $this->getProductUrl($product, $additional);
    }

}