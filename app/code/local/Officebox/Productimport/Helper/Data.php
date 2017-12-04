<?php
/*
* @Author : Durgesh Parmar
* @Comment: save Etilizer category to magento admin
* @Link : productimport/etilizercategory/getCategory
*/

class Officebox_Productimport_Helper_Data extends Mage_Core_Helper_Abstract
{
	
	public function getCategories() {
		global $backTrack;
		$backTrack = array();
		$parentId = 692; // parent category id from magento
		$id = 10358; // parent category id from etilizer
		$this->getParentCategory($parentId,$id);
	}
	
	public function getParentCategory($parentId,$id) {
	    $resource   = Mage::getSingleton('core/resource');
		$conn       = $resource->getConnection('etilizer_read');
		// 10358 : categoryid for technology category
		$results    = $conn->fetchAll('select categorynames.categoryid from category 
										inner join categorynames on categorynames.categoryid = category.categoryid 
										where category.parentcategoryid = '.$id.' and category.isactive=1');
		$this->saveEtilizerCategory($parentId,$results);
	}

	public function saveEtilizerCategory($parentId,$results,$level=null){
		$parentId = $parentId; 
		try{
			Mage::log('========== Etilizer-Category-Save Start ==========',null,'Etilizer-Category.log',true );
			if(!empty($results)) {
				foreach($results as $key => $val) {
					Mage::log($parentId.'=>'.$val['categoryid'], null, 'Etilizer-Category.log',true);
					
					$id= $val['categoryid'];
					$resource   = Mage::getSingleton('core/resource');
					$conn       = $resource->getConnection('etilizer_read');
					$results    = $conn->fetchAll('select categorynames.name from category 
												inner join categorynames on categorynames.categoryid = category.categoryid 
												where category.categoryid = '.$id.' and category.isactive=1');
					$categoryName = trim($results[0]['name']);
					$category = Mage::getModel('catalog/category');
					$category->setName($categoryName);
					$category->setIsActive(1);
					$category->setIncludeInMenu(0);
					$category->setEtilizerCategoryAttribute($id);
					$category->setStoreId(Mage::app()->getStore()->getId());
					$parentCategory = Mage::getModel('catalog/category')->load($parentId);
					$category->setPath($parentCategory->getPath());
					try{
						$category->save();
						$saveCategoryId = $category->getId();
						//$backTrack[] = $saveCategoryId;
					// 	// recursive call for getting neseted sub category
						$this->getParentCategory($saveCategoryId,$id);
						Mage::log('SaveCategoryId: '.$saveCategoryId,null,'Etilizer-Category.log',true );
					} catch(Exception $e) {
						Mage::log('Exception while saving category: '.$e->getMessage(),null,'Etilizer-Category.log',true );
						//print_r($e);
					}
				}
			} else {
				Mage::log('Result Empty for Category Id: '.$parentId, null, 'Etilizer-Category.log',true);
			}
		} catch(Exception $e) {
			Mage::log('Exception while connecting db: '.$e->getMessage(),null,'Etilizer-Category.log',true );
		}
		Mage::log('========== Etilizer-Category-Save End ==========',null,'Etilizer-Category.log',true );
	}

	public function saveManufacturer() {
		Mage::log('========== Etilizer-saveManufacturerStart ==========',null,'Etilizer-manufacturer.log',true );
 		$resource   = Mage::getSingleton('core/resource');
		$conn       = $resource->getConnection('etilizer_read');
		$writeConnection = $resource->getConnection('core_write');
		$results    = $conn->fetchAll('select manufacturerid,name,url from manufacturer');
		foreach($results as $key=> $val) {
			$name =  str_replace(",",'',$val['name']);
         	if($val['url'] != ''){
         		$value = '("'.$name.'","'.$val['url'].'")';
				$query = "INSERT into divante_manufacturer (`label`, `url_key`) VALUES ". $value;
				Mage::log('saveManufacturer: '.$query,null,'Etilizer-manufacturer.log',true );
        		$writeConnection->query($query);
         	}
        }
        $writeConnection->close();
        Mage::log('========== Etilizer-saveManufacturerStart ==========',null,'Etilizer-manufacturer.log',true );
	}

}
	 