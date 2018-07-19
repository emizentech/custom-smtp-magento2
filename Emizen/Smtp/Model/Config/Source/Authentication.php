<?php


namespace Emizen\Smtp\Model\Config\Source;

class Ssl implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [['value' => 'login', 'label' => __('Login')],['value' => 'none', 'label' => __('None')]];
    }

    public function toArray()
    {
        return ['login' => __('login'),'none' => __('none')];
    }
}
