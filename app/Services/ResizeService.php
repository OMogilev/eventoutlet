<?php


namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class ResizeService
{
    private const BASE_PATH = '/images';

    private const LEN_FILE_NAME = 20;

    private $stores = [
        'avatar' => 'avatar',
        'gallery' => 'gallery',
        'undefined' => 'undefined'
    ];

    private $presets = [
        'avatar' => [
            'height' => 200,
            'width' => 200,
            'mode' => 'center'
        ],
        'gallery' => [
            'height' => null,
            'width' => 1000
        ],
        'gallery_preview' => [
            'height' => 300,
            'width' => 300
        ],
    ];

    /**
     * @param $filename
     * @param $store
     * @param $options
     * @param string $mode
     * @return mixed
     */
    public function resize($filename, $store, $options, $mode = 'fit')
    {
        $image = $this->getImage($filename, $store);

        if (!$image) return null;

        if ($options['height'] && $options['width'] && $mode == 'fit') {
           $image = $image->fit($options['height'], $options['width'], function ($constraint) {
               $constraint->aspectRatio();
               $constraint->upsize();
           });
        }
        elseif ($mode == 'resize') {
            $image = $image->resize($options['height'], $options['width'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        return $image;
    }

    /**
     * @param string $path
     * @return string
     */
    public  function createPath(string $path = '')
    {
        return self::BASE_PATH . '/' . trim($path, '/');
    }

    /**
     * @param string $path
     * @return string
     */
    public function createOriginalPath(string $path)
    {
        return $this->createPath($path) . '/original';
    }

    public function createResizePath($path)
    {
        return $this->createPath($path) . '/resize';
    }

    /**
     * @param string $store
     * @return mixed|string
     */
    public function getStore(string $store)
    {
        return isset($this->stores[$store])? $this->stores[$store]: 'undefined';
    }

    /**
     * @param string $ext
     * @return string
     */
    public function createFileName($ext = 'jpg')
    {
        return Str::random(self::LEN_FILE_NAME) . '.' . $ext;
    }

    /**
     * @param string $store
     * @param bool $original
     * @return string
     */
    public function getFileFolder($store = 'undefined', $original = true)
    {
        if ($original) {
            return  $this->createOriginalPath($this->getStore($store));
        }

        return $this->createPath($this->getStore($store));
    }

    /**
     * @param UploadedFile $file
     * @param string $store
     * @param bool $original
     * @return array
     */
    public function store(UploadedFile $file, $store = 'undefined', $original = true)
    {
        $path = $this->getFileFolder($store, $original);
        $filename = $this->createFileName($file->getClientOriginalExtension());
        $fullPath = $file->storeAs($path, $filename);

        return [$fullPath, $filename];
    }

    /**
     * @param $filename
     * @param string $store
     * @param bool $original
     */
    public function remove($filename, $store = 'undefined', $original = true)
    {
        $path = $this->getFileFolder($store, $original);

        Storage::delete($path . '/' . $filename);
    }

    /**
     * @param $path
     * @param $filename
     * @return string
     */
    public function creatPathFile($path, $filename)
    {
        return $path . '/' . $filename;
    }

    /**
     * @param $path
     * @return string
     */
    public function createFullPathFile($path)
    {
        return storage_path('app' . $path);
    }

    /**
     * @param $file
     * @param $store
     * @return mixed
     */
    public function getImage($file, $store)
    {

        $path = $this->createFullPathFile($this->getFileFolder($store));

        return Image::make($this->creatPathFile($path, $file));
    }

    /**
     * @param $name
     * @return array|mixed
     */
    public function getPreset($name)
    {
        if (isset($this->presets[$name])) {
            return $this->presets[$name];
        }

        return [];

    }

    /**
     * @param $filename
     * @param string $height
     * @param string $width
     * @return string
     */
    public function createCacheName($filename, $height = 'nope', $width = 'nope') {

        $fileInfo = new \SplFileInfo($filename);
        $ext = $fileInfo->getExtension();
        $filename = $fileInfo->getBasename($ext);

        return "$filename{$height}x{$width}.$ext";
    }

    /**
     * @param $filename
     * @param $store
     * @param null $preset
     * @param array $options
     * @param string $mode
     * @return string|null
     * @throws \Exception
     */
    public function roc($filename, $store, $preset = null, $options = [], $mode = 'fit')
    {
        if (!$filename) return null;

        if ($preset) {
            $options = $this->getPreset($preset);
        }

        if (empty($options)) {
            throw new \Exception('Preset and options not exist');
        }

        $path = $this->createFullPathFile($this->createResizePath($store));

        $cacheFilename = $this->createCacheName($filename, $options['height'], $options['width']);

        if (!file_exists($this->creatPathFile($path, $cacheFilename))) {
            $image = $this->resize($filename, $store, $options, $mode);
            $image->save($this->creatPathFile($path, $cacheFilename));
        }

        return asset($this->creatPathFile($this->createResizePath($store), $cacheFilename));

    }

    /**
     * @param $filename
     * @param $store
     * @param bool $original
     * @return string
     */
    public function getFileUrl($filename, $store, $original = true)
    {
        return asset($this->creatPathFile($this->getFileFolder($store, $original), $filename));
    }
}
