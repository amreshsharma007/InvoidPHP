<?php


class BankAccountInterface
{
    public $completedAt; //Date

    /**
     * @var DataInterface
     */
    public $data; //Data
    public $docType; //String
    public $govtCheckStatus; //String

    /**
     * @var NameSimilarityInterface
     */
    public $nameSimilarity; //array( NameSimilarity )

    /**
     * @var RequestInterface
     */
    public $request; //Request
    public $status; //String
    public $transactionId; //String

}
