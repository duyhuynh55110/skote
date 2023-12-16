<?php

use App\Exceptions\StorageUploadFileException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

if (! function_exists('uploadImageToStorage')) {
    /**
     * Resize and upload image to storage
     *
     * @param Illuminate\Http\UploadedFile || Illuminate\Http\File $file
     * @param  int  $pWidth width you want to resize
     * @param  int  $pHeight height you want to resize
     * @param  string|null  $fileExtension
     * @param  bool  $saveOriginalImage save original image if true
     * @return void
     */
    function uploadImageToStorage(
        $file,
        string $fileName,
        int $pWidth,
        int $pHeight,
        $fileExtension = null,
        bool $saveOriginalImage = true
    ) {
        // check filename is invalid or not
        if (! empty($fileName) && ! preg_match(STORAGE_IMAGE_ALLOW_EXTENSION, $fileName)) {
            throw new StorageUploadFileException('File type is not allow, please change STORAGE_IMAGE_ALLOW_EXTENSION if you want to upload');
        }

        // image extension
        if (! $fileExtension) {
            if ($file instanceof Illuminate\Http\UploadedFile) {
                $fileExtension = $file->extension();
            } else {
                $fileExtension = $file->getClientOriginalExtension();
            }
        }

        // init image
        $image = Image::make($file);

        // save original image
        if ($saveOriginalImage) {
            // upload original image to storage
            $originalName = getFilenameSuffixOriginal($fileName);

            // original image
            $originalImage = $image->stream($fileExtension, STORAGE_IMAGE_QUANTITY)->detach();

            // upload original image to storage
            Storage::disk()->put($originalName, $originalImage);
        }

        // calculate width & height
        $width = $image->width();
        $height = $image->height();

        if ($width > $height) {
            if ($width > $pWidth) {
                $height *= $pWidth / $width;
                $width = $pWidth;
            }
        } else {
            if ($height > $pHeight) {
                $width *= $pHeight / $height;
                $height = $pHeight;
            }
        }

        // resize image
        $resizeImage = $image->resize($width, $height)->stream($fileExtension, STORAGE_IMAGE_QUANTITY)->detach();

        // upload resize image to storage
        Storage::disk()->put($fileName, $resizeImage);
    }
}

if (! function_exists('getFilenameSuffixOriginal')) {
    /**
     * Get file name with suffix original
     *
     * @param  string  $filename
     * @return string
     */
    function getFilenameSuffixOriginal($filename)
    {
        return preg_replace(STORAGE_IMAGE_ALLOW_EXTENSION, STORAGE_SUFFIX_ORIGINAL_RESIZE, $filename);
    }
}

if (! function_exists('deleteImageFromStorage')) {
    /**
     * Delete image from storage
     *
     * @return void
     */
    function deleteImageFromStorage(string $fileName)
    {
        $storage = Storage::disk();

        if ($storage->exists($fileName)) {
            $storage->delete($fileName);
        }

        // try to delete original file
        $fileOriginalName = getFilenameSuffixOriginal($fileName);
        if ($storage->exists($fileOriginalName)) {
            $storage->delete($fileOriginalName);
        }
    }
}

if (! function_exists('slugifyModel')) {
    /**
     * Generate a slug string
     *
     * @param string $text
     * @param string $separator
     * @return string
     */
    function slugifyModel(string $text, Model $modelCheckExists): string
    {
        $maxRetry = 3;
        $countTimes = 0;

        do {
            if($countTimes == $maxRetry) {
                break;
            }

            // from second times append a random number
            if($countTimes == 0) {
                $slugName = slugify($text);
            } else {
                $slugName = slugify($text) . '-' . randomNumber();
            }

            $countTimes++;
        } while($modelCheckExists->where([
            'slug_name' => $slugName
        ])->exists());

        return $slugName;
    }
}

if (! function_exists('slugify')) {
    /**
     * Generate a slug string
     *
     * @param string $text
     * @param string $separator
     * @return string
     */
    function slugify(string $text, string $separator = "-"): string
    {
        return \Illuminate\Support\Str::slug($text, $separator);
    }
}

if(! function_exists('randomNumber')) {
    /**
     * Generate a random digits number with length
     *
     * @param int $length
     * @return string
     */
    function randomNumber(int $length = 6): string
    {
        $result = '';

        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }
}

if(! function_exists('getAcceptLocaleHeader')) {
    /**
     * Get request header Accept-Locale value
     *
     * @return string
     */
    function getAcceptLocaleHeader(): string
    {
        return request()->header(REQUEST_HEADER_ACCEPT_LOCALE) ?? DEFAULT_LOCALE;
    }
}


if(! function_exists('displayNameByLocale')) {
    /**
     * Display name by header 'Accept-Locale'; default was 'en'
     *
     * @param Model $model
     * @return string
     */
    function displayNameByLocale(Model $model): string
    {
        $columnName = 'name_' . getAcceptLocaleHeader();

        // if not set display name for this locale -> display default locale
        if(!$model->$columnName) {
            $defaultColumnName = 'name_' . DEFAULT_LOCALE;
            return $model->$defaultColumnName;
        }

        // display value from column name
        return $model->$columnName;
    }
}

if(! function_exists('getFullPathToImage')) {
    /**
     * Get full path to image by column
     *
     * @param Model $model
     * @param string $columnName
     * @return string
     */
    function getFullPathToImage(Model $model, string $columnName): string
    {
        return $model->$columnName ?  Storage::url($model->$columnName) : null;
    }
}
