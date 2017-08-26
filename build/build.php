<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

require __DIR__ . '/../vendor/autoload.php';

/** @var \Symfony\Component\Finder\SplFileInfo[] $packages */
$packages = (new Finder())->directories()->in(__DIR__ . '/../vendor/railt')->depth(0);

function mklink(string $from, string $to)
{
    if (0 === stripos(PHP_OS, 'win')) {
        echo shell_exec('mklink /D "' . $to . '" "' . $from . '"');
    } else {
        echo shell_exec('ln -s "' . $from . '" "' . $to . '"');
    }
}

function download(string $repo): string
{
    $path = __DIR__ . '/../../' . $repo;

    echo shell_exec('git clone git@github.com:railt/' . $repo . '.git "' . $path . '"');

    return $path;
}

foreach ($packages as $package) {
    $name = $package->getFilename();
    $vendorLink = $package->getRealPath();

    $cloneTo  = __DIR__ . '/../../' . $name;

    $sourceFrom = $cloneTo . '/src';
    $sourceTo = __DIR__ . '/../src/Railt/' . Str::studly($name);

    echo shell_exec('rm -rf "' . $vendorLink . '"');

    $cloneTo = download($name);

    mklink($cloneTo, $vendorLink);
    mklink($sourceFrom, $sourceTo);
}

$docsPath = download('docs');
mklink($docsPath, __DIR__ . '/../docs');
