<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railgun\Reflection\Type;

use Hoa\Compiler\Llk\TreeNode;
use Railgun\Reflection\Abstraction\DocumentTypeInterface;
use Railgun\Reflection\Abstraction\Type\ListTypeInterface;
use Railgun\Reflection\Abstraction\Type\RelationTypeInterface;
use Railgun\Reflection\Abstraction\Type\TypeInterface;
use Railgun\Reflection\Document;

/**
 * Class BaseType
 * @package Railgun\Reflection\Type
 */
abstract class BaseType implements TypeInterface
{
    /**
     * @var Document
     */
    protected $document;

    /**
     * @var bool
     */
    private $nonNull = false;

    /**
     * BaseType constructor.
     * @param Document $document
     * @param TreeNode $ast
     */
    public function __construct(Document $document, TreeNode $ast)
    {
        $this->document = $document;

        /** @var TreeNode $child */
        foreach ($ast->getChildren() as $child) {
            if ($child->getValueToken() === 'T_NON_NULL') {
                $this->nonNull = true;
            }
        }
    }

    /**
     * @return DocumentTypeInterface
     */
    public function getDocument(): DocumentTypeInterface
    {
        return $this->document;
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        $result = [
            'nonNull' => $this->nonNull(),
        ];

        switch (true) {
            case $this instanceof ListTypeInterface:
                $result['of'] = $this->getChild();
                break;
            case $this instanceof RelationTypeInterface:
                $result['related'] = $this->getRelationDefinition();
                break;
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function nonNull(): bool
    {
        return $this->nonNull;
    }

    /**
     * @return string
     */
    public function getRelationName(): string
    {
        return $this->getRelationDefinition()->getName();
    }

    /**
     * @return bool
     */
    public function isList(): bool
    {
        return $this instanceof ListTypeInterface;
    }
}