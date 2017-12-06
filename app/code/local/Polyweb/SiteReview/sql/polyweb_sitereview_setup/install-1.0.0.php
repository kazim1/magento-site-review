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
 * SiteReview module install script
 *
 * @category    Polyweb
 * @package     Polyweb_SiteReview
 * @author      Ultimate Module Creator
 */
$this->startSetup();
$table = $this->getConnection()
    ->newTable($this->getTable('polyweb_sitereview/sitereview'))
    ->addColumn(
        'entity_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        array(
            'identity'  => true,
            'nullable'  => false,
            'primary'   => true,
        ),
        'Site Review ID'
    )
    ->addColumn(
        'title',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable'  => false,
        ),
        'Title'
    )
    ->addColumn(
        'customer_name',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Customer Name'
    )
    ->addColumn(
        'detail',
        Varien_Db_Ddl_Table::TYPE_TEXT, '64k',
        array(),
        'Detail'
    )
    ->addColumn(
        'city',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'City'
    )
    ->addColumn(
        'state',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'State'
    )
    ->addColumn(
        'customer_image',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(),
        'Customer Image'
    )
    ->addColumn(
        'rating',
        Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'unsigned'  => true,
        ),
        'Rating'
    )
    ->addColumn(
        'email',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable'  => false,
        ),
        'Email'
    )
    ->addColumn(
        'mobile',
        Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable'  => false,
        ),
        'Mobile'
    )
    ->addColumn(
        'status',
        Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(),
        'Enabled'
    )
    ->addColumn(
        'updated_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(),
        'Site Review Modification Time'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        array(),
        'Site Review Creation Time'
    ) 
    ->setComment('Site Review Table');
$this->getConnection()->createTable($table);
$this->endSetup();
