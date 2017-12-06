<?php


class Polyweb_SiteReview_IndexController extends Mage_Core_Controller_Front_Action
{
	
	public function thankYouAction()
	{
		
	}

    public function postAction()
    {
        $data = $this->getRequest()->getPost();
        if ( $data ) {
            try {
                
				$customerImageName = $this->_uploadAndGetName(
                    'customer_image',
                    Mage::helper('polyweb_sitereview/sitereview')->getFileBaseDir()
                );
				
				$model = Mage::getModel('polyweb_sitereview/sitereview');
				
				$data['customer_image'] = $customerImageName;
				$data['status'] = 1;
				$model->setData($data);
				$model->save();

                Mage::getSingleton('customer/session')->addSuccess(Mage::helper('contacts')->__('Thank you.'));
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                $translate->setTranslateInline(true);

                Mage::getSingleton('customer/session')->addError(Mage::helper('contacts')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
                return;
            }

        } else {
            $this->_redirect('*/*/');
        }
    }

	protected function _uploadAndGetName($input, $destinationFolder)
    {
        try {
                $uploader = new Varien_File_Uploader($input);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $uploader->setAllowCreateFolders(true);
                $result = $uploader->save($destinationFolder);
                return $result['file'];
        } catch (Exception $e) {}
        return '';
    }
	
}
