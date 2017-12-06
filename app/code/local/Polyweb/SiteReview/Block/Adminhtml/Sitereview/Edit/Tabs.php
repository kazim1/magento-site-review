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
 * Site Review admin edit tabs
 *
 * @category    Polyweb
 * @package     Polyweb_SiteReview
 * @author      Ultimate Module Creator
 */
class Polyweb_SiteReview_Block_Adminhtml_Sitereview_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize Tabs
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('sitereview_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('polyweb_sitereview')->__('Site Review'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return Polyweb_SiteReview_Block_Adminhtml_Sitereview_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_sitereview',
            array(
                'label'   => Mage::helper('polyweb_sitereview')->__('Site Review'),
                'title'   => Mage::helper('polyweb_sitereview')->__('Site Review'),
                'content' => $this->getLayout()->createBlock(
                    'polyweb_sitereview/adminhtml_sitereview_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve site review entity
     *
     * @access public
     * @return Polyweb_SiteReview_Model_Sitereview
     * @author Ultimate Module Creator
     */
    public function getSitereview()
    {
        return Mage::registry('current_sitereview');
    }
}
