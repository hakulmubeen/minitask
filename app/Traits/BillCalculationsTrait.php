<?php

namespace App\Traits;

trait BillCalculationsTrait
{
    public function calculateBillingDetails($billing)
    {
        $totalPriceWithoutTax = 0;
        $totalTaxPayable = 0;

        foreach ($billing->billedProducts as $billedProduct) {
            $product = $billedProduct->product;
            $quantity = $billedProduct->quantity;

            if ($product) {
                $priceWithoutTax = $product->price * $quantity;
                $tax = $priceWithoutTax * ($product->tax / 100);

                $totalPriceWithoutTax += $priceWithoutTax;
                $totalTaxPayable += $tax;
            }
        }

        $netPrice = $totalPriceWithoutTax + $totalTaxPayable;
        $roundedNetPrice = round($netPrice);
        $balancePayable = $billing->cash - $roundedNetPrice;

        return [
            'total_price_without_tax' => $totalPriceWithoutTax,
            'total_tax_payable' => $totalTaxPayable,
            'net_price' => $netPrice,
            'rounded_net_price' => $roundedNetPrice,
            'balance_payable' => $balancePayable
        ];
    }
    public function calculateDenominations($amount)
    {
        $denominations = [500, 50, 20, 10, 5, 2, 1];
        $denominationCount = [];

        foreach ($denominations as $denomination) {
            $denominationCount[$denomination] = intdiv($amount, $denomination);
            $amount %= $denomination;
        }

        return $denominationCount;
    }
}
