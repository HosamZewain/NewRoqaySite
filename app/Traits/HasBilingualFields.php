<?php

namespace App\Traits;

trait HasBilingualFields
{
    public function getLocalizedField(string $field): ?string
    {
        $locale = app()->getLocale();
        $localizedField = $field . '_' . $locale;
        $fallbackField = $field . '_' . ($locale === 'ar' ? 'en' : 'ar');

        return $this->{$localizedField} ?? $this->{$fallbackField} ?? null;
    }

    public function __get($key)
    {
        // Check if the key matches a bilingual field pattern
        if (!str_ends_with($key, '_ar') && !str_ends_with($key, '_en')) {
            $arField = $key . '_ar';
            if (in_array($arField, $this->bilingualFields ?? [])) {
                return $this->getLocalizedField($key);
            }
        }
        return parent::__get($key);
    }
}
