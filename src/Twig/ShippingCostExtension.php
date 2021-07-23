<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;


class ShippingCostExtension extends AbstractExtension
{
    private const SHIPPING_COST = 1000;
    
    public function getFilters()
    {
        return [
            new TwigFilter( 'shippingCost', [ $this, 'shippingCost_func'] )
        ];
    }

    public function shippingCost_func($sousTotal)
    {
        $total = $sousTotal + self::SHIPPING_COST;

        return $total;
    }
}