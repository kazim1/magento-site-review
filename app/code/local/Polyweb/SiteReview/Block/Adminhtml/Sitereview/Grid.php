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
 * Site Review admin grid block
 *
 * @category    Polyweb
 * @package     Polyweb_SiteReview
 * @author      Ultimate Module Creator
 */
class Polyweb_SiteReview_Block_Adminhtml_Sitereview_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * constructor
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('sitereviewGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * prepare collection
     *
     * @access protected
     * @return Polyweb_SiteReview_Block_Adminhtml_Sitereview_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('polyweb_sitereview/sitereview')
            ->getCollection();
        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare grid collection
     *
     * @access protected
     * @return Polyweb_SiteReview_Block_Adminhtml_Sitereview_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            array(
                'header' => Mage::helper('polyweb_sitereview')->__('Id'),
                'index'  => 'entity_id',
                'type'   => 'number'
            )
        );
        $this->addColumn(
            'title',
            array(
                'header'    => Mage::helper('polyweb_sitereview')->__('Title'),
                'align'     => 'left',
                'index'     => 'title',
            )
        );
        
        $this->addColumn(
            'status',
            array(
                'header'  => Mage::helper('polyweb_sitereview')->__('Status'),
                'index'   => 'status',
                'type'    => 'options',
                'options' => array(
                    '1' => Mage::helper('polyweb_sitereview')->__('Enabled'),
                    '0' => Mage::helper('polyweb_sitereview')->__('Disabled'),
                )
            )
        );
        $this->addColumn(
            'customer_name',
            array(
                'header' => Mage::helper('polyweb_sitereview')->__('Customer Name'),
                'index'  => 'customer_name',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'city',
            array(
                'header' => Mage::helper('polyweb_sitereview')->__('City'),
                'index'  => 'city',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'state',
            array(
                'header' => Mage::helper('polyweb_sitereview')->__('State'),
                'index'  => 'state',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'rating',
            array(
                'header' => Mage::helper('polyweb_sitereview')->__('Rating'),
                'index'  => 'rating',
                'type'=> 'number',

            )
        );
        $this->addColumn(
            'email',
            array(
                'header' => Mage::helper('polyweb_sitereview')->__('Email'),
                'index'  => 'email',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'mobile',
            array(
                'header' => Mage::helper('polyweb_sitereview')->__('Mobile'),
                'index'  => 'mobile',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'created_at',
            array(
                'header' => Mage::helper('polyweb_sitereview')->__('Created at'),
                'index'  => 'created_at',
                'width'  => '120px',
                'type'   => 'datetime',
            )
        );
        $this->addColumn(
            'action',
            array(
                'header'  =>  Mage::helper('polyweb_sitereview')->__('Action'),
                'width'   => '100',
                'type'    => 'action',
                'getter'  => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('polyweb_sitereview')->__('Edit'),
                        'url'     => array('base'=> '*/*/edit'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'is_system' => true,
                'sortable'  => false,
            )
        );
        $this->addExportType('*/*/exportCsv', Mage::helper('polyweb_sitereview')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('polyweb_sitereview')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('polyweb_sitereview')->__('XML'));
        return parent::_prepareColumns();
    }

    /**
     * prepare mass action
     *
     * @access protected
     * @return Polyweb_SiteReview_Block_Adminhtml_Sitereview_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('sitereview');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'=> Mage::helper('polyweb_sitereview')->__('Delete'),
                'url'  => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('polyweb_sitereview')->__('Are you sure?')
            )
        );
        $this->getMassactionBlock()->addItem(
            'status',
            array(
                'label'      => Mage::helper('polyweb_sitereview')->__('Change status'),
                'url'        => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'status' => array(
                        'name'   => 'status',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('polyweb_sitereview')->__('Status'),
                        'values' => array(
                            '1' => Mage::helper('polyweb_sitereview')->__('Enabled'),
                            '0' => Mage::helper('polyweb_sitereview')->__('Disabled'),
                        )
                    )
                )
            )
        );
        return $this;
    }

    /**
     * get the row url
     *
     * @access public
     * @param Polyweb_SiteReview_Model_Sitereview
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * get the grid url
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * after collection load
     *
     * @access protected
     * @return Polyweb_SiteReview_Block_Adminhtml_Sitereview_Grid
     * @author Ultimate Module Creator
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
}
