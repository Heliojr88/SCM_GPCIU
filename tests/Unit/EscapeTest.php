<?php
declare(strict_types=1);

namespace GpciuTests\Unit;

use PHPUnit\Framework\TestCase;

final class EscapeTest extends TestCase
{
    public function testEscapesHtmlSpecialCharacters(): void
    {
        self::assertSame('&lt;script&gt;', e('<script>'));
        self::assertSame('&quot;&#039;', e('"\''));
        self::assertSame('a &amp; b', e('a & b'));
    }

    public function testNullReturnsEmptyString(): void
    {
        self::assertSame('', e(null));
    }

    public function testNumericIsCastToString(): void
    {
        self::assertSame('42', e(42));
        self::assertSame('3.14', e(3.14));
    }
}
