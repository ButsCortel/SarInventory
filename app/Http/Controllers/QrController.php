<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode as FacadesQrCode;

class QrController extends Controller
{

    // public function __construct(QrCode $qrCode)
    // {
    //     $this->qrCode = $qrCode;
    // }

    public function makeQrCode($text)
    {
        $image =  FacadesQrCode::format('png')->size(300)->errorCorrection('H')->generate($text);
        return response($image)->header('Content-type', 'image/png');
    }
}
