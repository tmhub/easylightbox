<?php

class TM_EasyLightbox_Adminhtml_Easylightbox_ImageController extends Mage_Adminhtml_Controller_Action
{
    public function saveAction()
    {
        $path = Mage::getBaseDir('media') . '/easylightbox/';
        if ($this->getRequest()->isPost()) {
            try{
                $uploader = new Varien_File_Uploader('image');
                $uploader->setFilesDispersion(true);
                $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                $uploader->setAllowRenameFiles(true);
                $result = $uploader->save($path);
            } catch (Exception $e) {
                return $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array(
                    'success' => false,
                    'message' => $e->getMessage()
                )));
            }
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array(
                'success' => true,
                'path'    => $result['file']
            )));
        }
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('templates_master/easylightbox/image');
    }
}
