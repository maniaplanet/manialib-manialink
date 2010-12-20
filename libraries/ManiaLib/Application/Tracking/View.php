<?php

class ManiaLib_Application_Tracking_View extends ManiaLib_Application_View
{
	function display()
	{
		if($this->response->trackingURL)
		{
			$ui = new Quad(0, 0);
			$ui->setPosition(200, 200);
			$ui->setImage($this->response->trackingURL, false);
			$ui->save();
		}
	} 
}


?>