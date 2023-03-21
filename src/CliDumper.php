<?php

declare(strict_types=1);

namespace BuzzingPixel\SymfonyVarDumperDecorator;

use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Dumper\CliDumper as BaseDumper;
use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;

// phpcs:disable SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingAnyTypeHint

class CliDumper extends BaseDumper
{
    private readonly Context $context;

    public function __construct(
        $output = null,
        string|null $charset = null,
        int $flags = 0,
    ) {
        parent::__construct($output, $charset, $flags);

        $this->context = new Context(
            new SourceContextProvider(),
        );
    }

    public function dump(Data $data, $output = null): string|null
    {
        $context = $this->context->get();

        if ($context === '') {
            return parent::dump($data, $output);
        }

        parent::echoLine($context, 0, '');

        return parent::dump($data, $output);
    }
}
