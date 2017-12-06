<?php

class Polyweb_SiteReview_Block_SiteReview extends Mage_Core_Block_Template
{
	public function getFormAction()
	{
		return Mage::getUrl('sitereview/index/post', array('_secure' => Mage::app()->getRequest()->isSecure()));
	}
}