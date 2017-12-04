<?php
$this->startSetup();
$this->addAttribute(Mage_Catalog_Model_Category::ENTITY, 'etilizer_category_attribute', array(
    'group'         => 'General Information',
    'input'         => 'text',
    'type'          => 'text',
    'label'         => 'Etilizer Category Id',
    'backend'       => '',
    'visible'       => true,
    'required'      => false,
    'visible_on_front' => false,
    'readonly' => true,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
));

$this->endSetup();