<?php
class Officebox_Productimport_EtilizercategoryController extends Mage_Core_Controller_Front_Action
{

	public function getCategoryAction() { 
		echo Mage::helper('productimport')->getCategories(); exit;
    }

    public function saveManufacturerAction() { 
		echo Mage::helper('productimport')->saveManufacturer(); exit;
    }
}

