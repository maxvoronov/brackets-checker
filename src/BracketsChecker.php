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

class BracketsChecker implements BracketsCheckerInterface
{
    protected $sentence;

    public function __construct(string $sentence)
    {
        // ToDo: Sentece validation
        $this->sentence = $sentence;
    }

    /**
     * @return bool
     */
    public function isCorrect(): bool
    {
        // ToDo: Implement isCorrect() method
        return true;
    }
}
