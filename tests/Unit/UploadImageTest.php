<?php
declare(strict_types=1);

namespace GpciuTests\Unit;

use PHPUnit\Framework\TestCase;

final class UploadImageTest extends TestCase
{
    private string $destDir;
    private array $tmpFiles = [];

    protected function setUp(): void
    {
        $this->destDir = SCM_STORAGE_DIR . '/uploads_test_' . bin2hex(random_bytes(3));
        $_FILES = [];
    }

    protected function tearDown(): void
    {
        foreach ($this->tmpFiles as $f) {
            if (is_file($f)) {
                @unlink($f);
            }
        }
        if (is_dir($this->destDir)) {
            foreach (glob($this->destDir . '/*') ?: [] as $entry) {
                @unlink($entry);
            }
            @rmdir($this->destDir);
        }
    }

    private function makeFakeUpload(string $field, string $mime): string
    {
        $tmp = tempnam(sys_get_temp_dir(), 'scm_upload_');
        $this->tmpFiles[] = $tmp;

        $bytes = match ($mime) {
            'image/png'  => base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII='),
            'image/jpeg' => base64_decode('/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCAABAAEDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAn/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAX/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwA/8A/9k='),
            'text/plain' => 'not an image',
            default      => '',
        };
        file_put_contents($tmp, $bytes);

        $_FILES[$field] = [
            'name'     => 'file.dat',
            'type'     => $mime,
            'tmp_name' => $tmp,
            'error'    => UPLOAD_ERR_OK,
            'size'     => filesize($tmp),
        ];
        return $tmp;
    }

    public function testNoFileReturnsNull(): void
    {
        $err = null;
        self::assertNull(upload_image('foto', $this->destDir, $err));
        self::assertNull($err);
    }

    public function testRejectsBadMimeType(): void
    {
        $this->makeFakeUpload('foto', 'text/plain');
        $err = null;
        self::assertNull(upload_image('foto', $this->destDir, $err));
        self::assertNotNull($err);
        self::assertStringContainsString('nao permitido', $err);
    }

    public function testAcceptsValidPng(): void
    {
        $this->makeFakeUpload('foto', 'image/png');
        $err = null;
        $name = upload_image('foto', $this->destDir, $err);
        self::assertNull($err);
        self::assertNotNull($name);
        self::assertStringEndsWith('.png', $name);
        self::assertFileExists($this->destDir . '/' . $name);
    }

    public function testSizeLimitEnforced(): void
    {
        $this->makeFakeUpload('foto', 'image/png');
        $err = null;
        self::assertNull(upload_image('foto', $this->destDir, $err, 10));
        self::assertNotNull($err);
        self::assertStringContainsString('tamanho', $err);
    }

    public function testUploadErrorIsReported(): void
    {
        $_FILES['foto'] = [
            'name'     => 'x.png',
            'type'     => 'image/png',
            'tmp_name' => '/nonexistent',
            'error'    => UPLOAD_ERR_INI_SIZE,
            'size'     => 0,
        ];
        $err = null;
        self::assertNull(upload_image('foto', $this->destDir, $err));
        self::assertNotNull($err);
        self::assertStringContainsString('codigo', $err);
    }
}
