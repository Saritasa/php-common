<?php

namespace Saritasa\Enums;

use Saritasa\NamedEnum;

/**
 * How user pays money
 */
class PaymentType extends NamedEnum
{
    const ANDROID_PAY = 'Android Pay';
    const APPLE_PAY = 'Apple Pay';
    const CREDIT_CARD = 'Credit Card';
}
