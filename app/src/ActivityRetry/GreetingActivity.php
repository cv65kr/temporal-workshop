<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Samples\ActivityRetry;

use Temporal\Activity;
use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;
use Temporal\Exception\IllegalStateException;

#[ActivityInterface(prefix: 'ActivityRetry.')]
class GreetingActivity
{
    #[ActivityMethod(name: "ComposeGreeting")]
    public function composeGreeting(string $greeting, string $name): string
    {
        if (Activity::getInfo()->attempt < 4) {
            throw new IllegalStateException("not yet");
        }

        return $greeting . ' ' . $name;
    }
}