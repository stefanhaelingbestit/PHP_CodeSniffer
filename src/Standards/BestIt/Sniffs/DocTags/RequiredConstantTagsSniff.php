<?php

declare(strict_types=1);

namespace BestIt\Sniffs\DocTags;

use BestIt\Sniffs\ConstantRegistrationTrait;

/**
 * Sniffs the required tags of a constant.
 *
 * @author blange <bjoern.lange@bestit-online.de>
 * @package BestIt\Sniffs\DocTags
 */
class RequiredConstantTagsSniff extends AbstractRequiredTagsSniff
{
    use ConstantRegistrationTrait;
}
