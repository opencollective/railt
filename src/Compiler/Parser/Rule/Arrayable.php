<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Parser\Rule;

/**
 * Interface Arrayable
 */
interface Arrayable
{
    /**
     * @return array
     */
    public function toArray(): array;
}
