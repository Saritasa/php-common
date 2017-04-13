<?php

namespace Saritasa\Enums;

use Saritasa\Enum;

/**
 * How user pays money
 */
class PaymentType extends Enum
{
    const ANDROID_PAY = 'Android Pay';
    const APPLE_PAY = 'Apple Pay';
    const CREDIT_CARD = 'Credit Card';
}
