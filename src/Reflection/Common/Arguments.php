<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railgun\Reflection\Common;

use Hoa\Compiler\Llk\TreeNode;
use Railgun\Reflection\Abstraction\ArgumentInterface;
use Railgun\Reflection\Abstraction\Common\HasArgumentsInterface;
use Railgun\Reflection\Abstraction\DocumentTypeInterface;
use Railgun\Reflection\Abstraction\NamedDefinitionInterface;
use Railgun\Reflection\Argument;

/**
 * Trait HasArguments
 * @package Railgun\Reflection\Common
 * @mixin HasArgumentsInterface
 */
trait Arguments
{
    /**
     * @var array
     */
    private $arguments = [];

    /**
     * @return iterable|ArgumentInterface[]
     */
    public function getArguments(): iterable
    {
        return array_values($this->arguments);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasArgument(string $name): bool
    {
        return array_key_exists($name, $this->arguments);
    }

    /**
     * @param string $name
     * @return null|ArgumentInterface
     */
    public function getArgument(string $name): ?ArgumentInterface
    {
        return $this->arguments[$name] ?? null;
    }

    /**
     * @param DocumentTypeInterface $document
     * @param TreeNode $ast
     */
    protected function compileArguments(DocumentTypeInterface $document, TreeNode $ast): void
    {
        $allowed = in_array($ast->getId(), (array)($this->astHasArguments ?? ['#Argument']), true);

        if ($allowed && $this instanceof NamedDefinitionInterface) {
            $argument = new Argument($document, $ast, $this);
            $this->arguments[$argument->getName()] = $argument;
        }
    }
}