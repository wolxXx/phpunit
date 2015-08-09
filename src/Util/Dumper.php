<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

/**
 * Wrapper for Symfony VarDumper.
 *
 * @since Class available since Release 5.1.0
 */
class PHPUnit_Util_Dumper
{
    /**
     * @param  mixed $variable
     * @return string
     */
    public function dump($variable)
    {
        $cloner = new VarCloner;
        $dumper = new CliDumper;
        $output = fopen('php://memory', 'r+b');

        $dumper->dump($cloner->cloneVar($variable), $output);

        return rtrim(stream_get_contents($output, -1, 0));
    }
}
