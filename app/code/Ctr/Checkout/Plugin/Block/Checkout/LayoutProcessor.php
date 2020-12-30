<?php

namespace Ctr\Checkout\Plugin\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor as ParentProcessor;

class LayoutProcessor
{
    /**
     * add number validation to billing address
     *
     * @param ParentProcessor $subject
     * @param array $result
     * @return array
     * @@SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterProcess(ParentProcessor $subject, $result)
    {
        if (isset($result['components']['checkout']['children']['steps']['children']['billing-step']['children']
            ['payment']['children']['payments-list']['children']
        )) {
            foreach ($result['components']['checkout']['children']['steps']['children']['billing-step']['children']
                     ['payment']['children']['payments-list']['children'] as $key => $payment) {
                /* telephone */
                $result['components']['checkout']['children']['steps']['children']['billing-step']['children']
                ['payment']['children']['payments-list']['children'][$key]['children']['form-fields']['children']
                ['telephone']['validation'] = ['required-entry' => true,"validate-number"=>true];
            }
        }
        return $result;
    }
}
