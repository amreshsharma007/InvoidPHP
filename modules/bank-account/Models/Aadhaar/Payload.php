<?php


namespace App\Models\Invoid;


use App\Models\AadhaarData;

class Payload
{
    public $mobile; //String
    public $userId; //String

    /**
     * @var AadhaarData $aadhaarData
     */
    public $aadhaarData; //AadhaarData

    /**
     * @var Location $location
     */
    public $location; //Location
    /**
     * @var PanData $panData
     */
    public $panData; //PanData

    /**
     * @var QuestionData $questionData
     */
    public $questionData; //QuestionData

    /**
     * @var OcrData $ocrData
     */
    public $ocrData; //OcrData
    public $urls; //String
}
