<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function created(Product $product)
    {
        $this->removeCache($product);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function updated(Product $product)
    {
        $this->removeCache($product);
    }

    private function removeCache($product)
    {
        $locales = \LaravelLocalization::getSupportedLocales();

        // Remove cache products
        foreach ($locales as $key => $value) {
            \Cache::forget("{$key}_composer_products");
        }
    }
}