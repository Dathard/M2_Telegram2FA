<?php

declare(strict_types=1);

namespace Dathard\Telegram2FA\Block\Adminhtml\System\Config\Form;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Url;

class CallbackUrl extends Field
{
    /**
     * @var Url
     */
    private $urlBuilder;

    /**
     * @param Context   $context
     * @param Url       $urlBuilder
     * @param array     $data
     */
    public function __construct(
        Context $context,
        Url $urlBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @inherit
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $callbackUrl = $this->urlBuilder->getUrl('rest/default/V1/dttelegram2fa/update-chats-data');

        return <<<INPUT
<input
id="{$element->getHtmlId()}"
type="text"
name=""
value="{$callbackUrl}"
class="input-text"
style="background-color: #EEE; color: #999;"
readonly="readonly"
/>
INPUT;
    }
}
