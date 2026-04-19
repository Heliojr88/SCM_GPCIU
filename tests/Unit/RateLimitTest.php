<?php
declare(strict_types=1);

namespace GpciuTests\Unit;

use PHPUnit\Framework\TestCase;

final class RateLimitTest extends TestCase
{
    private string $key;

    protected function setUp(): void
    {
        $this->key = 'test-' . bin2hex(random_bytes(4));
    }

    protected function tearDown(): void
    {
        rate_limit_reset($this->key);
    }

    public function testFirstHitsDoNotExceedLimit(): void
    {
        self::assertFalse(rate_limit_hit($this->key, 5, 60));
        self::assertFalse(rate_limit_hit($this->key, 5, 60));
        self::assertFalse(rate_limit_hit($this->key, 5, 60));
    }

    public function testExceedsLimitAfterMaxAttempts(): void
    {
        for ($i = 0; $i < 3; $i++) {
            self::assertFalse(rate_limit_hit($this->key, 3, 60));
        }
        self::assertTrue(rate_limit_hit($this->key, 3, 60));
    }

    public function testResetClearsCounter(): void
    {
        for ($i = 0; $i < 4; $i++) {
            rate_limit_hit($this->key, 3, 60);
        }
        rate_limit_reset($this->key);
        self::assertFalse(rate_limit_hit($this->key, 3, 60));
    }

    public function testFileStoredUnderScmStorageDir(): void
    {
        rate_limit_hit($this->key, 5, 60);
        $file = rate_limit_file($this->key);
        self::assertStringStartsWith(SCM_STORAGE_DIR, $file);
        self::assertFileExists($file);
    }
}
