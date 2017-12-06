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
 * Site Review admin block
 *
 * @category    Polyweb
 * @package     Polyweb_SiteReview
 * @author      Ultimate Module Creator
 */
class Polyweb_SiteReview_Block_Adminhtml_Sitereview extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        $this->_controller         = 'adminhtml_sitereview';
        $this->_blockGroup         = 'polyweb_sitereview';
        parent::__construct();
        $this->_headerText         = Mage::helper('polyweb_sitereview')->__('Site Review');
        $this->_updateButton('add', 'label', Mage::helper('polyweb_sitereview')->__('Add Site Review'));

    }
}
