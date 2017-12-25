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

interface BracketsCheckerInterface
{
    public function isCorrect(): bool;
}
