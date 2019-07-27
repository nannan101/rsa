<?php

namespace Src;

class Praser
{
    use Traits\Signleton;

    private $encodeStr;

    private $privateKey;

    protected function __construct(array $encodeStr = [])
    {
        $this->encodeStr = $encodeStr;
        $this->privateKey = __DIR__.'/Pem/private.pem';
    }

    public function decode()
    {
        if (!$this->encodeStr) {
            return '';
        }

        $private = openssl_pkey_get_private(file_get_contents($this->privateKey));
        foreach ($this->encodeStr as $key => $code) {
            openssl_private_decrypt(base64_decode($code), $decrypted, $private, OPENSSL_PKCS1_PADDING);
            $decrypteds[$key] = $decrypted;
        }

        return json_encode($decrypteds);
    }
}
