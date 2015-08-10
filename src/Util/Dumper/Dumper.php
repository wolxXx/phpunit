<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\VarDumper\Cloner\Cursor;
use Symfony\Component\VarDumper\Dumper\CliDumper;

/**
 * Wrapper for Symfony VarDumper.
 *
 * @since Class available since Release 5.1.0
 */
class PHPUnit_Util_Dumper_Dumper extends CliDumper
{
    /**
     * Dumps while entering an hash.
     *
     * @param Cursor $cursor   The Cursor position in the dump.
     * @param int    $type     A Cursor::HASH_* const for the type of hash.
     * @param string $class    The object class, resource type or array count.
     * @param bool   $hasChild When the dump of the hash has child item.
     */
    public function enterHash(Cursor $cursor, $type, $class, $hasChild)
    {
        $hashKey = $cursor->hashKey;

        if (Cursor::HASH_OBJECT === $type && 'stdClass' === $class) {
            $this->dumpKey($cursor);

            $this->line .= $this->style('note', $class);

            $cursor->hashKey = null;
        }

        parent::enterHash($cursor, $type, $class, $hasChild);

        $cursor->hashKey = $hashKey;
    }
}
