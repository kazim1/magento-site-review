<?php
/**
 * Polyweb_SiteReview extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Polyweb
 * @package        Polyweb_SiteReview
 * @copyright      Copyright (c) 2016
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Admin search model
 *
 * @category    Polyweb
 * @package     Polyweb_SiteReview
 * @author      Ultimate Module Creator
 */
class Polyweb_SiteReview_Model_Adminhtml_Search_Sitereview extends Varien_Object
{
    /**
     * Load search results
     *
     * @access public
     * @return Polyweb_SiteReview_Model_Adminhtml_Search_Sitereview
     * @author Ultimate Module Creator
     */
    public function load()
    {
        $arr = array();
        if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
            $this->setResults($arr);
            return $this;
        }
        $collection = Mage::getResourceModel('polyweb_sitereview/sitereview_collection')
            ->addFieldToFilter('title', array('like' => $this->getQuery().'%'))
            ->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
            ->load();
        foreach ($collection->getItems() as $sitereview) {
            $arr[] = array(
                'id'          => 'sitereview/1/'.$sitereview->getId(),
                'type'        => Mage::helper('polyweb_sitereview')->__('Site Review'),
                'name'        => $sitereview->getTitle(),
                'description' => $sitereview->getTitle(),
                'url' => Mage::helper('adminhtml')->getUrl(
                    '*/sitereview_sitereview/edit',
                    array('id'=>$sitereview->getId())
                ),
            );
        }
        $this->setResults($arr);
        return $this;
    }
}
