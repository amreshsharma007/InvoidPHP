<?php

//namespace InvoidPHP\BankAccount\

class InvoidService
{

    private $authKey;
    private $guzzle_client;
    private $invoid_gc_url = 'https://gc.invoid.co';

    public function __construct($authKey)
    {
        $this->authKey = $authKey;
        $this->guzzle_client = new Client([
            'base_uri' => $this->invoid_gc_url,
            'timeout' => 180,
            'verify' => false
        ]);

        /**
         * Implement Caching
         * in network call
         *
         * So that we don't have to make call
         * multiple times
         */
//        $cachePlugin = new CachePlugin(array(
//            'storage' => new DefaultCacheStorage(
//                new DoctrineCacheAdapter(
//                    new FilesystemCache('/path/to/cache/files')
//                )
//            )
//        ));
    }

    /**
     * @param BankAccount $bankAccount
     * @return BankAccountInterface
     */
    public function isBankAccountOk($bankAccount)
    {
        if (empty($this->authKey)) {
            return true;
        }

        /**
         * Fetch the server
         */
        $response = $this->guzzle_client->post('/v3', [
            'headers' => [
                'authkey' => $this->authKey
            ],
            'form_params' => [
//                'docType' => 'bank-account',
                'docNumber' => $bankAccount->accountNumber,
                'ifsc' => $bankAccount->ifsc,
                'form-name' => $bankAccount->accountHolder
            ]
        ]);

        return json_decode((string)$response->getBody());

        /**
         * Possible responses
         */
        // {"data":{},"docType":"bank-account","govtCheckStatus":"Failure","message":"Service Provider Downtime","request":{"docNumber":"126101512884","docType":"bank-account","ifsc":"ICIC0001261"},"status":"17","transactionId":"ab7b135d-2ca9-4e55-bb69-874f1a6dd511","utcTimestamp":"2021-05-13 20:50:09.745435"}

//        try {
//            if ($responseBody->data->result->status->status !== '1' || $responseBody->data->result->status->value !== 'VERIFIED') {
//                throw new Error('Data status not verified');
//            } else if ($responseBody->govtCheckStatus !== 'Success') {
//                throw new Error('Govt check status not success');
//            } else if ($responseBody->status !== '1') {
//                throw new Error('status not 1');
//            }
//            return true;
//        } catch (Exception $e) {
//            Log::error($e);
//        }

//        return false;
    }

    /**
     * @param $ifsc
     * @return mixed|null
     */
    public function fetchIFSCDetails($ifsc)
    {
        try {
            $json = @file_get_contents(
                "https://ifsc.razorpay.com/" . $ifsc);
            return json_decode($json);
        } catch (Exception $e) {
            Log::error($e);
        }
        return null;
    }
}