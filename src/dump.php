<?php

declare(strict_types=1);

namespace BuzzingPixel\SymfonyVarDumperDecorator;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\ContextProvider\CliContextProvider;
use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;
use Symfony\Component\VarDumper\Dumper\ServerDumper;
use Symfony\Component\VarDumper\VarDumper;

use function getenv;
use function in_array;

use const PHP_SAPI;

VarDumper::setHandler(static function ($var): void {
    $cloner = new VarCloner();

    $isCli = in_array(
        PHP_SAPI,
        ['cli', 'phpdbg'],
        true,
    );

    $serverAddress = (string) getenv('VAR_DUMPER_SERVER_ADDRESS');

    $serverAddress = $serverAddress !== '' ?
        $serverAddress :
        'tcp://127.0.0.1:9912';

    $htmlDumper = new HtmlDumper();

    $varDumperTheme = (string) getenv('VAR_DUMPER_THEME');

    $varDumperTheme = $varDumperTheme !== '' ? $varDumperTheme : 'light';

    $htmlDumper->setTheme($varDumperTheme);

    $dumper = new ServerDumper(
        $serverAddress,
        $isCli ? new CliDumper() : $htmlDumper,
        [
            'cli' => new CliContextProvider(),
            'source' => new SourceContextProvider(),
        ],
    );

    $dumper->dump($cloner->cloneVar($var));
});
