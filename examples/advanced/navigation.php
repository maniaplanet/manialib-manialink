<?php
/**
 * Navigation menu
 * @author Maxime Raoust
 */

$request = RequestEngine::getInstance();

$ui = new Navigation;
$ui->title->setText("ManiaLib");
$ui->subTitle->setText("Lightweight PHP framework");
$ui->logo->setImage("logo64.dds");

$link = $request->createLinkArgList("index.php");
$ui->addItem();
$ui->lastItem()->text->setText(__("home"));
$ui->lastItem()->icon->setSubStyle("United");
$ui->lastItem()->setManialink($link);

$link = $request->createLinkArgList("layouts.php");
$ui->addItem();
$ui->lastItem()->text->setText("Layouts demo");
$ui->lastItem()->icon->setSubStyle("Advanced");
$ui->lastItem()->setManialink($link);

$ui->addGap(66);

if(DEBUG_LEVEL >= DEBUG_ON)
{
	$link = $request->createLinkArgList("admin/index.php");
	
	$ui->addItem();
	$ui->lastItem()->text->setText(__("admin"));
	$ui->lastItem()->icon->setSubStyle("ProfileAdvanced");
	$ui->lastItem()->setManialink($link);	
}

if($request->get("post_id"))
{
	$linkstr = $request->createLinkArgList("index.php");
	$ui->quitButton->setManialink($linkstr);
}
else
{
	$ui->quitButton->setAction(0);
	$ui->quitButton->text->setText("Quit");
}



$ui->save();

?>