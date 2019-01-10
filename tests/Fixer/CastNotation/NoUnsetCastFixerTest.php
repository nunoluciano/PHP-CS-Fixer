<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpCsFixer\Tests\Fixer\CastNotation;

use PhpCsFixer\Tests\Test\AbstractFixerTestCase;

/**
 * @internal
 *
 * @covers \PhpCsFixer\Fixer\CastNotation\NoUnsetCastFixer
 */
final class NoUnsetCastFixerTest extends AbstractFixerTestCase
{
    /**
     * @param string      $expected
     * @param null|string $input
     *
     * @dataProvider provideFixCases
     */
    public function testFix($expected, $input = null)
    {
        $this->doTest($expected, $input);
    }

    public function provideFixCases()
    {
        return [
            'simple form I' => [
                "<?php\n\$a = null;",
                "<?php\n\$a =(unset)\$z;",
            ],
            'simple form II' => [
                "<?php\n\$a = null;",
                "<?php\n\$a = (unset)\$z;",
            ],
            'lot of spaces' => [
                "<?php\n\$a = \t \t \t null;",
                "<?php\n\$a = \t (unset)\$z\t \t ;",
            ],
            'comments' => [
                '<?php
#0
$a#1
#2
= null#3
#4
#5
#6
#7
#8
;
',
                '<?php
#0
$a#1
#2
=#3
#4
(unset)#5
#6
$b#7
#8
;
',
            ],
            [
                "<?php\n(unset) \$b;",
            ],
        ];
    }
}
