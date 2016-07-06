<?php
/**
 * mc-magento Magento Component
 *
 * @category Ebizmarts
 * @package mc-magento
 * @author Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date: 6/9/16 4:05 PM
 * @file: mysql4-upgrade-1.0.1-1.0.2.php
 */

$installer = $this;

$installer->startSetup();


try {
    $installer->run("
 ALTER TABLE `{$this->getTable('sales_flat_quote_item')}` ADD column `mailchimp_sync_delta` datetime NOT NULL;
 ALTER TABLE `{$this->getTable('sales_flat_quote_item')}` ADD column `mailchimp_sync_error` VARCHAR(255) NOT NULL;
 ALTER TABLE `{$this->getTable('sales_flat_quote')}` ADD column `mailchimp_deleted` INT(1) NOT NULL DEFAULT 0;
 ALTER TABLE `{$this->getTable('sales_flat_quote')}` ADD column `mailchimp_token` VARCHAR(255) NOT NULL DEFAULT '';
 ALTER TABLE `{$this->getTable('sales_flat_quote')}` ADD column `mailchimp_abandonedcart_flag` INT(1) NOT NULL DEFAULT 0;
");
}
catch (Exception $e)
{
    Mage::helper('mailchimp')->logError($e->getMessage());
}

$installer->endSetup();