<?php

namespace Modules\User\Tests\Unit;

use Modules\User\Services\VerifyCodeService;
use Tests\TestCase;

class VerifyCodeServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_verification_code_is_6_digit()
    {
        $code = VerifyCodeService::generate();

        $this->assertIsNumeric($code , 'generated code is not numeric');
        $this->assertLessThanOrEqual(999999 , $code , 'generated code is LessThanOrEqual than 999999 digit');
        $this->assertGreaterThanOrEqual(100000 , $code , 'generated code is GreaterThanOrEqual than 100000 digit');
    }
    public function test_verify_code_can_store()
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(1 , $code);

        $this->assertEquals(cache()->get('verification_code_1') , $code);
    }
}
