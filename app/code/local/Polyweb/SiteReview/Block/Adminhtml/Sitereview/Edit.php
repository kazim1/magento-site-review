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
 * Site Review admin edit form
 *
 * @category    Polyweb
 * @package     Polyweb_SiteReview
 * @author      Ultimate Module Creator
 */
class Polyweb_SiteReview_Block_Adminhtml_Sitereview_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
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
        parent::__construct();
        $this->_blockGroup = 'polyweb_sitereview';
        $this->_controller = 'adminhtml_sitereview';
        $this->_updateButton(
            'save',
            'label',
            Mage::helper('polyweb_sitereview')->__('Save Site Review')
        );
        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('polyweb_sitereview')->__('Delete Site Review')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('polyweb_sitereview')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );
        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * get the edit form header
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_sitereview') && Mage::registry('current_sitereview')->getId()) {
            return Mage::helper('polyweb_sitereview')->__(
                "Edit Site Review '%s'",
                $this->escapeHtml(Mage::registry('current_sitereview')->getTitle())
            );
        } else {
            return Mage::helper('polyweb_sitereview')->__('Add Site Review');
        }
    }
}
