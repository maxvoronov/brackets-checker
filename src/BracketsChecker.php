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

use MaxVoronov\BracketsChecker\Exceptions\InvalidArgumentException;

class BracketsChecker implements BracketsCheckerInterface
{
    protected $sentence;

    /**
     * BracketsChecker constructor
     *
     * @param string $sentence
     * @throws InvalidArgumentException
     */
    public function __construct(string $sentence)
    {
        $this->validateSentence($sentence);
        $this->sentence = $sentence;
    }

    /**
     * Parse and check the correctness of the sentence
     *
     * @return bool
     */
    public function isCorrect(): bool
    {
        $openBracketsCount = 0;
        $symbols = str_split($this->sentence);
        foreach ($symbols as $symbol) {
            if ($symbol === "(") {
                $openBracketsCount++;
            } elseif ($symbol === ")") {
                $openBracketsCount--;
            }

            // If close bracket comes before open bracket
            if ($openBracketsCount < 0) {
                return false;
            }
        }

        return ($openBracketsCount == 0);
    }

    /**
     * Validate sentence string
     *
     * @param string $sentence
     * @throws InvalidArgumentException
     */
    protected function validateSentence(string $sentence): void
    {
        if (empty($sentence)) {
            throw new InvalidArgumentException("Sentence can not be empty");
        }

        if (preg_match("/[^\(\)\n\t\r ]/", $sentence)) {
            throw new InvalidArgumentException("Sentence contains invalid symbols");
        }
    }
}
