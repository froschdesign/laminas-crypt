<?php

namespace LaminasTest\Crypt\FileCipher;

use Laminas\Crypt\FileCipher;
use Laminas\Crypt\Symmetric;
use Laminas\Crypt\Symmetric\Openssl;

class OpensslTest extends AbstractFileCipherTest
{
    public function setUp(): void
    {
        try {
            $this->fileCipher = new FileCipher(new Openssl);
        } catch (Symmetric\Exception\RuntimeException $e) {
            $this->markTestSkipped($e->getMessage());
        }
        parent::setUp();
    }

    public function testDefaultCipher()
    {
        $fileCipher = new FileCipher();
        $this->assertInstanceOf(Openssl::class, $fileCipher->getCipher());
    }

    public function testSetCipher()
    {
        $cipher = new Openssl([
            'algo' => 'blowfish'
        ]);
        $this->fileCipher->setCipher($cipher);
        $this->assertInstanceOf('Laminas\Crypt\Symmetric\SymmetricInterface', $this->fileCipher->getCipher());
        $this->assertEquals($cipher, $this->fileCipher->getCipher());
    }
}
