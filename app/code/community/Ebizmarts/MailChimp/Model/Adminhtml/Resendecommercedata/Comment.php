<?php

class Ebizmarts_MailChimp_Model_Adminhtml_Resendecommercedata_Comment
{
    /**
     * @var Ebizmarts_MailChimp_Helper_Data
     */
    protected $_mcHelper;

    public function __construct()
    {
        $this->setMcHelper();
    }

    /**
     * @return Ebizmarts_MailChimp_Helper_Data
     */
    public function getMcHelper()
    {
        return $this->_mcHelper;
    }

    /**
     * @param Ebizmarts_MailChimp_Helper_Data $mcHelper
     */
    public function setMcHelper()
    {
        $this->_mcHelper = Mage::helper('mailchimp');
    }

    /**
     * @return string
     */
    public function getCommentText()
    {
        $scopeArray = $this->_mcHelper->getCurrentScope();
        $scope = $scopeArray['scope'];

        if ($scope == "default"){
            $comment = $this->_mcHelper->__("This will resend the ecommerce data "
                ."for all Websites and Store Views.");
        } else {
            $websiteOrStoreViewScope = $this->_getScope($scopeArray);
            $comment = $this->_mcHelper->__("This will resend the ecommerce data "
                ."for ". $websiteOrStoreViewScope . " only.");
        }

        return $comment;
    }

    /**
     * @param $scopeArray
     * @return string
     */
    protected function _getScope($scopeArray)
    {
        $scope = $scopeArray['scope'];
        if ($scope == "websites"){
            $result = "this Website";
        } else {
            $result = "this Store View";
        }

        return $result;
    }
}
