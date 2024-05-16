<?php

declare(strict_types=1);

/*
 * This file is part of Contao Development Server Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

namespace TwoBiased\ContaoDevelopmentServerBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use TwoBiased\ContaoDevelopmentServerBundle\TwoBiasedContaoDevelopmentServerBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(TwoBiasedContaoDevelopmentServerBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
