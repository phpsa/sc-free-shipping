<?php

namespace Phpsa\ScFreeShipping\ShippingMethods;

use Statamic\Entries\Entry;
use DoubleThreeDigital\SimpleCommerce\SessionCart;
use DoubleThreeDigital\SimpleCommerce\Contracts\ShippingMethod;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Statamic\Facades\Site;
use DoubleThreeDigital\SimpleCommerce\Facades\Cart;
use DoubleThreeDigital\SimpleCommerce\Facades\Currency;

class FreeShipping implements ShippingMethod
{
    use SessionCart;

    public function name(): string
    {
        $siteConfig = $this->getConfig();
        $min_order = $siteConfig['min_order'];
        if($min_order === null) {

            return __('sc-free-shipping::messages.free_shipping'); //'Name of your shipping method';
        }

        return __('sc-free-shipping::messages.free_shipping_over', ['over' =>  Currency::parse($min_order, Site::current())]); //'Name of your shipping method';
    }

    public function description(): string
    {
        return __('sc-free-shipping::messages.free_shipping_desc');
    }

    public function calculateCost(Entry $order): int
    {

        return 0;
    }

    public function checkAvailability(array $address): bool
    {
        if ($this->hasSessionCart()) {
            $total = $this->getSessionCart()->entry()->toAugmentedArray()['items_total']->raw();
        }


        $siteConfig = $this->getConfig();


        if($siteConfig['min_order'] !== null && (int) $siteConfig['min_order'] < (int) $total) {
            return false;
        }

        if($siteConfig['max_order'] !== null && $siteConfig['max_order'] > $total) {

            return false;
        }

        return true;
    }

    protected function getConfig()
    {
        return collect(Config::get('sc-free-shipping.sites'))
            ->get(Site::current()->handle());
    }
}
