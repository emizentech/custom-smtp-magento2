<?php


namespace Emizen\Smtp\Model\Config\Source;

class Ssl implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return [['value' => 'ssl', 'label' => __('ssl')],['value' => 'tls', 'label' => __('tls')]];
    }

    public function toArray()
    {
        return ['ssl' => __('ssl'),'tls' => __('tls')];
    }
}
