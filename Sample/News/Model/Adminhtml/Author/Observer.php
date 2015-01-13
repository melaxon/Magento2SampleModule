<?php
namespace Sample\News\Model\Adminhtml\Author;

use \Magento\Framework\Registry;
use \Magento\Framework\UrlInterface;
use \Magento\Backend\Helper\Js as JsHelper;
use \Magento\Backend\App\Action\Context;
use \Sample\News\Model\Resource\Author;

class Observer
{
    /**
     * @var \Magento\Framework\Registry|null
     */
    protected $coreRegistry;
    /**
     * @var \Magento\Framework\UrlInterface|null
     */
    protected $urlBuilder;
    /**
     * @var \Magento\Backend\Helper\Js|null
     */
    protected $jsHelper;
    /**
     * @var \Magento\Backend\App\Action\Context|null
     */
    protected $context;
    /**
     * @var \Sample\News\Model\Resource\Author
     */
    protected $authorResource;

    /**
     * @param Registry $coreRegistry
     * @param UrlInterface $urlBuilder
     * @param JsHelper $jsHelper
     * @param Context $context
     * @param Author $authorResource
     */
    public function __construct(
        Registry $coreRegistry,
        UrlInterface $urlBuilder,
        JsHelper $jsHelper,
        Context $context,
        Author $authorResource
    ) {
        $this->coreRegistry   = $coreRegistry;
        $this->urlBuilder     = $urlBuilder;
        $this->jsHelper       = $jsHelper;
        $this->context        = $context;
        $this->authorResource = $authorResource;
    }


    /**
     * save product data
     * @param $observer
     * @return $this
     */
    public function saveProductData($observer)
    {
        $post = $this->context->getRequest()->getPost('authors', -1);
        if ($post != '-1') {
            $post = $this->jsHelper->decodeGridSerializedInput($post);
            $product = $this->coreRegistry->registry('product');
            $this->authorResource->saveAuthorProductRelation($product, $post);
        }
        return $this;
    }
}
