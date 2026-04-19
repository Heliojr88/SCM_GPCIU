<?php
declare(strict_types=1);

namespace GpciuTests\Unit;

use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase
{
    protected function setUp(): void
    {
        $_GET     = [];
        $_POST    = [];
        $_REQUEST = [];
    }

    public function testReqIntValidInteger(): void
    {
        $_REQUEST['id'] = '42';
        self::assertSame(42, req_int('id'));
    }

    public function testReqIntInvalidReturnsDefault(): void
    {
        $_REQUEST['id'] = 'abc';
        self::assertSame(99, req_int('id', 99));
    }

    public function testReqIntMissingReturnsDefault(): void
    {
        self::assertNull(req_int('missing'));
        self::assertSame(7, req_int('missing', 7));
    }

    public function testReqIntRespectsSource(): void
    {
        $_POST['n']    = '10';
        $_GET['n']     = '20';
        $_REQUEST['n'] = '30';
        self::assertSame(10, req_int('n', null, 'POST'));
        self::assertSame(20, req_int('n', null, 'GET'));
        self::assertSame(30, req_int('n'));
    }

    public function testReqIdRejectsNonPositive(): void
    {
        $_REQUEST['id'] = '0';
        self::assertNull(req_id('id'));
        $_REQUEST['id'] = '-1';
        self::assertNull(req_id('id'));
        $_REQUEST['id'] = '5';
        self::assertSame(5, req_id('id'));
    }

    public function testReqStrTrimsAndTruncates(): void
    {
        $_REQUEST['name'] = '  hello  ';
        self::assertSame('hello', req_str('name'));

        $_REQUEST['name'] = str_repeat('a', 10);
        self::assertSame('aaaaa', req_str('name', '', 'REQUEST', 5));
    }

    public function testReqStrMissingReturnsDefault(): void
    {
        self::assertSame('', req_str('missing'));
        self::assertSame('fallback', req_str('missing', 'fallback'));
    }

    public function testReqStrNonScalarReturnsDefault(): void
    {
        $_REQUEST['arr'] = ['x'];
        self::assertSame('default', req_str('arr', 'default'));
    }

    public function testReqStrZeroMaxLenSkipsTruncation(): void
    {
        $_REQUEST['name'] = str_repeat('b', 1000);
        self::assertSame(1000, strlen(req_str('name', '', 'REQUEST', 0)));
    }
}
