<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;

class ImageArrayRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): void  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if value is an array
        if (!is_array($value)) {
            $fail(__('validation.image_array.array'));
            return;
        }

        // Check each file in the array
        foreach ($value as $index => $file) {
            // Skip if file is null or empty (but still check if it's a valid empty value)
            if ($file === null || $file === '') {
                continue;
            }

            // Check if it's an uploaded file
            if (!($file instanceof UploadedFile)) {
                $fail(__('validation.image_array.array'));
                return;
            }

            // Check if file upload was successful
            if (!$file->isValid()) {
                $fail(__('validation.image_array.image'));
                return;
            }

            // Get MIME type
            $mimeType = $file->getMimeType();
            
            // Check if it's an image
            if (!$mimeType || !str_starts_with($mimeType, 'image/')) {
                $fail(__('validation.image_array.image'));
                return;
            }

            // Check if it's JPG (MIME type for JPG is image/jpeg)
            if ($mimeType !== 'image/jpeg' && $mimeType !== 'image/png') {
                $fail(__('validation.image_array.mimes'));
                return;
            }

            // Check file size (2048KB = 2MB)
            $maxSize = 2048 * 1024; // 2048KB in bytes
            if ($file->getSize() > $maxSize) {
                $fail(__('validation.image_array.max'));
                return;
            }
        }
    }
}
