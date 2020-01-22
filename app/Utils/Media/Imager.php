<?php


namespace App\Utils\Media;


use App\Services\ResizeService;

class Imager
{

    /**
     * @var ResizeService
     */
    private $resize;

    public function __construct(ResizeService $resize)
    {
        $this->resize = $resize;
    }

    public function avatar($path)
    {
        if ($path) {
            return $this->resize->roc($path, 'avatar', 'avatar');
        }

        return asset('/assets/avatars/'.random_int(1,6).'.png');
    }

    public function gallery($path)
    {
        if ($path) {
            return $this->resize->roc($path, 'gallery', 'gallery', [], 'resize');
        }

        return asset('/assets/avatars/'.random_int(1,6).'.png');
    }
}
