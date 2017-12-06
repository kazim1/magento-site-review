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
 * Site Review edit form tab
 *
 * @category    Polyweb
 * @package     Polyweb_SiteReview
 * @author      Ultimate Module Creator
 */
class Polyweb_SiteReview_Block_Adminhtml_Sitereview_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Polyweb_SiteReview_Block_Adminhtml_Sitereview_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('sitereview_');
        $form->setFieldNameSuffix('sitereview');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'sitereview_form',
            array('legend' => Mage::helper('polyweb_sitereview')->__('Site Review'))
        );
        $fieldset->addType(
            'file',
            Mage::getConfig()->getBlockClassName('polyweb_sitereview/adminhtml_sitereview_helper_file')
        );

        $fieldset->addField(
            'title',
            'text',
            array(
                'label' => Mage::helper('polyweb_sitereview')->__('Title'),
                'name'  => 'title',
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'customer_name',
            'text',
            array(
                'label' => Mage::helper('polyweb_sitereview')->__('Customer Name'),
                'name'  => 'customer_name',

           )
        );

        $fieldset->addField(
            'detail',
            'textarea',
            array(
                'label' => Mage::helper('polyweb_sitereview')->__('Detail'),
                'name'  => 'detail',

           )
        );

        $fieldset->addField(
            'city',
            'text',
            array(
                'label' => Mage::helper('polyweb_sitereview')->__('City'),
                'name'  => 'city',

           )
        );

        $fieldset->addField(
            'state',
            'text',
            array(
                'label' => Mage::helper('polyweb_sitereview')->__('State'),
                'name'  => 'state',

           )
        );

        $fieldset->addField(
            'customer_image',
            'file',
            array(
                'label' => Mage::helper('polyweb_sitereview')->__('Customer Image'),
                'name'  => 'customer_image',

           )
        );

        $fieldset->addField(
            'rating',
            'text',
            array(
                'label' => Mage::helper('polyweb_sitereview')->__('Rating'),
                'name'  => 'rating',

           )
        );

        $fieldset->addField(
            'email',
            'text',
            array(
                'label' => Mage::helper('polyweb_sitereview')->__('Email'),
                'name'  => 'email',
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'mobile',
            'text',
            array(
                'label' => Mage::helper('polyweb_sitereview')->__('Mobile'),
                'name'  => 'mobile',
                'required'  => true,
                'class' => 'required-entry',

           )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('polyweb_sitereview')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('polyweb_sitereview')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('polyweb_sitereview')->__('Disabled'),
                    ),
                ),
            )
        );
        $formValues = Mage::registry('current_sitereview')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getSitereviewData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getSitereviewData());
            Mage::getSingleton('adminhtml/session')->setSitereviewData(null);
        } elseif (Mage::registry('current_sitereview')) {
            $formValues = array_merge($formValues, Mage::registry('current_sitereview')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
