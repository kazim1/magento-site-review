<?php

class Polyweb_SiteReview_Model_Observer {
	
	public function sendReviewEmail( Varien_Event_Observer $observer )
	{
		$order = $observer->getEvent()->getOrder();	
	}
	
}