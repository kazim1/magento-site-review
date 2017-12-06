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
 * Site Review admin controller
 *
 * @category    Polyweb
 * @package     Polyweb_SiteReview
 * @author      Ultimate Module Creator
 */
class Polyweb_SiteReview_Adminhtml_Sitereview_SitereviewController extends Polyweb_SiteReview_Controller_Adminhtml_SiteReview
{
    /**
     * init the site review
     *
     * @access protected
     * @return Polyweb_SiteReview_Model_Sitereview
     */
    protected function _initSitereview()
    {
        $sitereviewId  = (int) $this->getRequest()->getParam('id');
        $sitereview    = Mage::getModel('polyweb_sitereview/sitereview');
        if ($sitereviewId) {
            $sitereview->load($sitereviewId);
        }
        Mage::register('current_sitereview', $sitereview);
        return $sitereview;
    }

    /**
     * default action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title(Mage::helper('polyweb_sitereview')->__('Site Reviews'))
             ->_title(Mage::helper('polyweb_sitereview')->__('Site Reviews'));
        $this->renderLayout();
    }

    /**
     * grid action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction()
    {
        $this->loadLayout()->renderLayout();
    }

    /**
     * edit site review - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $sitereviewId    = $this->getRequest()->getParam('id');
        $sitereview      = $this->_initSitereview();
        if ($sitereviewId && !$sitereview->getId()) {
            $this->_getSession()->addError(
                Mage::helper('polyweb_sitereview')->__('This site review no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getSitereviewData(true);
        if (!empty($data)) {
            $sitereview->setData($data);
        }
        Mage::register('sitereview_data', $sitereview);
        $this->loadLayout();
        $this->_title(Mage::helper('polyweb_sitereview')->__('Site Reviews'))
             ->_title(Mage::helper('polyweb_sitereview')->__('Site Reviews'));
        if ($sitereview->getId()) {
            $this->_title($sitereview->getTitle());
        } else {
            $this->_title(Mage::helper('polyweb_sitereview')->__('Add site review'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new site review action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save site review - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('sitereview')) {
            try {
                $sitereview = $this->_initSitereview();
                $sitereview->addData($data);
                $customerImageName = $this->_uploadAndGetName(
                    'customer_image',
                    Mage::helper('polyweb_sitereview/sitereview')->getFileBaseDir(),
                    $data
                );
                $sitereview->setData('customer_image', $customerImageName);
                $sitereview->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('polyweb_sitereview')->__('Site Review was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $sitereview->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                if (isset($data['customer_image']['value'])) {
                    $data['customer_image'] = $data['customer_image']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setSitereviewData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                if (isset($data['customer_image']['value'])) {
                    $data['customer_image'] = $data['customer_image']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('polyweb_sitereview')->__('There was a problem saving the site review.')
                );
                Mage::getSingleton('adminhtml/session')->setSitereviewData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('polyweb_sitereview')->__('Unable to find site review to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete site review - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $sitereview = Mage::getModel('polyweb_sitereview/sitereview');
                $sitereview->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('polyweb_sitereview')->__('Site Review was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('polyweb_sitereview')->__('There was an error deleting site review.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('polyweb_sitereview')->__('Could not find site review to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete site review - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $sitereviewIds = $this->getRequest()->getParam('sitereview');
        if (!is_array($sitereviewIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('polyweb_sitereview')->__('Please select site reviews to delete.')
            );
        } else {
            try {
                foreach ($sitereviewIds as $sitereviewId) {
                    $sitereview = Mage::getModel('polyweb_sitereview/sitereview');
                    $sitereview->setId($sitereviewId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('polyweb_sitereview')->__('Total of %d site reviews were successfully deleted.', count($sitereviewIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('polyweb_sitereview')->__('There was an error deleting site reviews.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass status change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction()
    {
        $sitereviewIds = $this->getRequest()->getParam('sitereview');
        if (!is_array($sitereviewIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('polyweb_sitereview')->__('Please select site reviews.')
            );
        } else {
            try {
                foreach ($sitereviewIds as $sitereviewId) {
                $sitereview = Mage::getSingleton('polyweb_sitereview/sitereview')->load($sitereviewId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d site reviews were successfully updated.', count($sitereviewIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('polyweb_sitereview')->__('There was an error updating site reviews.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export as csv - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction()
    {
        $fileName   = 'sitereview.csv';
        $content    = $this->getLayout()->createBlock('polyweb_sitereview/adminhtml_sitereview_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as MsExcel - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction()
    {
        $fileName   = 'sitereview.xls';
        $content    = $this->getLayout()->createBlock('polyweb_sitereview/adminhtml_sitereview_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as xml - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction()
    {
        $fileName   = 'sitereview.xml';
        $content    = $this->getLayout()->createBlock('polyweb_sitereview/adminhtml_sitereview_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('polyweb_sitereview/sitereview');
    }
}
