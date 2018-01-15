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

use MaxVoronov\BracketsChecker\Exceptions\EmptySentenceException;
use MaxVoronov\BracketsChecker\Exceptions\InvalidCharactersException;

class Checker implements CheckerInterface
{
    protected $brackets;
    protected $availableChars;

    /**
     * Checker constructor
     *
     * @param array $brackets
     * @param array $availableChars
     */
    public function __construct(
        array $brackets = ["(" => ")"],
        array $availableChars = ["\n", "\t", "\r", " "]
    ) {
        $this->brackets = $brackets;
        $this->availableChars = array_merge(array_keys($brackets), array_values($brackets), $availableChars);
    }

    /**
     * Check brackets in sentence
     *
     * @param string $sentence
     * @return bool
     * @throws EmptySentenceException
     * @throws InvalidCharactersException
     */
    public function check(string $sentence): bool
    {
        $this->validateSentence($sentence);
        return $this->isCorrect($sentence);
    }

    /**
     * Parse and check the correctness of the sentence
     *
     * @param string $sentence
     * @return bool
     */
    protected function isCorrect(string $sentence): bool
    {
        $bracketsStack = [];
        $sentenceChars = str_split($sentence);
        $openBrackets = array_keys($this->brackets);
        foreach ($sentenceChars as $char) {
            if (in_array($char, $openBrackets)) {
                $bracketsStack[] = $this->brackets[$char];
                continue;
            }

            if (in_array($char, $this->brackets)) {
                $idx = array_search($char, $bracketsStack);
                if ($idx !== false) {
                    unset($bracketsStack[$idx]);
                    continue;
                }
                return false;
            }
        }

        return count($bracketsStack) === 0;
    }

    /**
     * Validate sentence string
     *
     * @param string $sentence
     * @throws EmptySentenceException
     * @throws InvalidCharactersException
     */
    protected function validateSentence(string $sentence): void
    {
        if (empty($sentence)) {
            throw new EmptySentenceException("Sentence can not be empty");
        }

        $sentenceChars = str_split($sentence);
        if (count(array_diff($sentenceChars, $this->availableChars))) {
            throw new InvalidCharactersException("Sentence contains invalid symbols");
        }
    }
}
