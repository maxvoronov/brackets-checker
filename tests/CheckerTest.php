<?php
/*
 * This file is part of the Brackets Checker library.
 *
 * (c) Max Voronov <maxivoronov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MaxVoronov\BracketsChecker;

use PHPUnit\Framework\TestCase;

class CheckerTest extends TestCase
{
    /** @var Checker */
    protected $bracketsChecker;

    public function setUp()
    {
        $this->bracketsChecker = new Checker();
    }

    public function testCorrect()
    {
        $this->assertTrue($this->bracketsChecker->check("\t(() ((\n)(()))(\r))"));
    }

    public function testMissedOpenBracket()
    {
        $this->assertFalse($this->bracketsChecker->check("(()) ) ()"));
    }

    public function testMissedCloseBracket()
    {
        $this->assertFalse($this->bracketsChecker->check("(()) ( ()"));
    }

    public function testFirstCloseBracket()
    {
        $this->assertFalse($this->bracketsChecker->check(")("));
    }

    public function testEmptySentence()
    {
        $this->expectException(Exceptions\EmptySentenceException::class);
        $this->bracketsChecker->check("");
    }

    public function testWrongSymbols()
    {
        $this->expectException(Exceptions\InvalidCharactersException::class);
        $this->bracketsChecker->check("((2 + 3) * (10 / (9 - 4))");
    }

    public function testCustomBrackets()
    {
        $bracketsChecker = new Checker(["(" => ")", "[" => "]", "<" => ">"]);
        $this->assertTrue($bracketsChecker->check("([ <\r\n>()]\t)"));
    }

    public function testCustomAvailableSymbols()
    {
        $availableChars = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "+", "-", "*", "/", " "];
        $bracketsChecker = new Checker(["(" => ")"], $availableChars);
        $this->assertTrue($bracketsChecker->check("((2 + 3) * (10 / (9 - 4)))"));
    }
}
