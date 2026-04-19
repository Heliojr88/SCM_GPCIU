<?php
declare(strict_types=1);

namespace GpciuTests\Unit;

use PHPUnit\Framework\TestCase;

final class CryptoTest extends TestCase
{
    public function testEncryptProducesVersionedPrefix(): void
    {
        $cipher = scm_encrypt('hello');
        self::assertStringStartsWith('v1:', $cipher);
    }

    public function testEncryptDecryptRoundtrip(): void
    {
        $plain = 'usuario.teste@exemplo.com';
        $cipher = scm_encrypt($plain);
        self::assertSame($plain, scm_decrypt($cipher));
    }

    public function testEncryptProducesDifferentCiphertextEachCall(): void
    {
        $a = scm_encrypt('mesmo-valor');
        $b = scm_encrypt('mesmo-valor');
        self::assertNotSame($a, $b, 'Nonce aleatorio deve produzir ciphertexts distintos');
    }

    public function testDecryptRejectsInvalidPrefix(): void
    {
        self::assertNull(scm_decrypt('plain text without prefix'));
        self::assertNull(scm_decrypt('v2:' . base64_encode('garbage')));
    }

    public function testDecryptRejectsTamperedCiphertext(): void
    {
        $cipher = scm_encrypt('payload sensivel');
        $tampered = substr($cipher, 0, -4) . 'XXXX';
        self::assertNull(scm_decrypt($tampered));
    }

    public function testHmacIsDeterministic(): void
    {
        $a = scm_hmac('12345678901');
        $b = scm_hmac('12345678901');
        self::assertSame($a, $b);
        self::assertSame(64, strlen($a));
    }

    public function testHmacDiffersForDifferentInputs(): void
    {
        self::assertNotSame(scm_hmac('abc'), scm_hmac('abd'));
    }

    public function testCryptoKeyRequiresCorrectLength(): void
    {
        $originalKey = getenv('SCM_APP_KEY');
        try {
            putenv('SCM_APP_KEY=tooshort');
            $this->expectException(\RuntimeException::class);
            scm_crypto_key();
        } finally {
            putenv('SCM_APP_KEY=' . ($originalKey ?: ''));
        }
    }
}
