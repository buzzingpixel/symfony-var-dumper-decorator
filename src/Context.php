<?php

declare(strict_types=1);

namespace BuzzingPixel\SymfonyVarDumperDecorator;

use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;

use function implode;

class Context
{
    public function __construct(
        private readonly SourceContextProvider $sourceContextProvider,
    ) {
    }

    public function get(): string
    {
        $source = $this->sourceContextProvider->getContext();

        $file = (string) ($source['file'] ?? '');

        $line = (string) ($source['line'] ?? '');

        $context = [];

        if ($file !== '') {
            $context[] = $file;
        }

        if ($line !== '') {
            $context[] = $line;
        }

        return implode(':', $context);
    }
}
