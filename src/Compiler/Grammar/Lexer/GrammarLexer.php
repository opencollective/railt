<?php
/**
 * This file is part of Lexer package.
 * 
 * For the full copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Grammar\Lexer;

use Railt\Compiler\Lexer\Token as GrammarLexerToken;
use Railt\Compiler\Lexer\Runtime as GrammarLexerRuntime;

/**
 * This class has been auto-generated by the Railt\Compiler\Generator
 */
final class GrammarLexer extends GrammarLexerRuntime
{
    public function getBuildingDate(): string
    {
        return '2018-03-19UTC22:09:54.166+00:00';
    }

    public function pattern(): string
    {
        return '/((?<T357>\\s+)|(?<T358>\\/\\/[^\\n]*)|(?<T359>\\/\\*.*?\\*\\/)|(?<T360>%pragma\\h+([\\w\\.]+)\\h+(.+?)\\s+)|(?<T361>%token\\h+(\\w+)\\h+(.+?)(?:\\h+\\->\\h+(\\w+))?\\s+)|(?<T362>%skip\\h+(\\w+)\\h+(.+?)\\s+)|(?<T363>%include\\h+(.+?)\\s+)|(?<T364>(#?\\w+)\\s*:)|(?<T365>\\|)|(?<T366>\\?)|(?<T367>\\+)|(?<T368>\\*)|(?<T369>{\\h*(\\d+),\\h*(\\d+)\\h*})|(?<T370>{\\h*,\\h*(\\d+)\\h*})|(?<T371>{\\h*(\\d+)\\h*,\\h*})|(?<T372>{(\\d+)})|(?<T373>::(\\w+)::)|(?<T374><(\\w+)>)|(?<T375>(\\w+)\\(\\))|(?<T376>#(\\w+))|(?<T377>\\()|(?<T378>\\)))/mus';
    }

    public function channels(): array
    {
        return [
            -1 => 'system',
            357 => 'skip',
            'skip',
            'skip',
        ];
    }

    public function identifiers(): array
    {
        return [
            -1 => 'EOF',
            357 => 17,
            18,
            19,
            32,
            33,
            34,
            35,
            36,
            49,
            50,
            51,
            52,
            53,
            54,
            55,
            56,
            57,
            58,
            59,
            60,
            61,
            62,
        ];
    }
}