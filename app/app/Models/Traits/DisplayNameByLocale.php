<?php

namespace App\Models\Traits;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait DisplayNameByLocale {
    /**
     * Get & set products.slug_name
     *
     * @return Attribute
     */
    public function slugName(): Attribute
    {
        return Attribute::make(
            set: function (string $val) {
                return slugifyModel($val, $this);
            }
        );
    }

    /**
     * Get valid name by header locale
     *
     * @return Attribute
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: function () {
                return displayNameByLocale($this);
            }
        );
    }
}
