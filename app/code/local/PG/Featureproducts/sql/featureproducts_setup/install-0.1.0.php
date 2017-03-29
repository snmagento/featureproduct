<?php
$installer = new Mage_Catalog_Model_Resource_Eav_Mysql4_Setup('core_setup');
$installer->startSetup();
$installer->removeAttribute('catalog_product', 'use_in_featured_widget');
$installer->addAttribute('catalog_product', 'use_in_featured_widget', array(
    'group' => 'General',
    'input' => 'select',
    'type' => 'int',
    'label' => 'Featured Product',
    'source' => 'eav/entity_attribute_source_boolean',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => 1,
    'required' => 0,
    'visible_on_front' => 0,
    'is_html_allowed_on_front' => 0,
    'is_configurable' => 0,
    'searchable' => 0,
    'filterable' => 0,
    'comparable' => 0,
    'unique' => false,
    'user_defined' => false,
    'default' => 0,
    'is_user_defined' => false,
    'used_in_product_listing' => true
));
$installer->endSetup();
