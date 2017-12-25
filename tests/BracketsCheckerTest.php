<?php
/*
 * This file is part of the Brackets Checker library.
 *
 * (c) Max Voronov <maxivoronov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MaxVoronov;

use PHPUnit\Framework\TestCase;

class BracketsCheckerTest extends TestCase
{
    public function testCorrect()
    {
        $checker = new BracketsChecker("\t(() ((\n)(()))(\r))");
        $this->assertTrue($checker->isCorrect());
    }

    public function testMissedOpenBracket()
    {
        $checker = new BracketsChecker("(()) ) ()");
        $this->assertFalse($checker->isCorrect());
    }

    public function testMissedCloseBracket()
    {
        $checker = new BracketsChecker("(()) ( ()");
        $this->assertFalse($checker->isCorrect());
    }

    public function testEmptySentence()
    {
        $this->expectException(Exceptions\InvalidArgumentException::class);
        new BracketsChecker("");
    }

    public function testWrongSymbols()
    {
        $this->expectException(Exceptions\InvalidArgumentException::class);
        new BracketsChecker("((2 + 3) * (10 / (9 - 4))");
    }
}
