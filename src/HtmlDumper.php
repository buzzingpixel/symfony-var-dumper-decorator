<?php

declare(strict_types=1);

namespace BuzzingPixel\SymfonyVarDumperDecorator;

use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;
use Symfony\Component\VarDumper\Dumper\HtmlDumper as BaseDumper;

// phpcs:disable SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingAnyTypeHint
// phpcs:disable SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingTraversableTypeHintSpecification

class HtmlDumper extends BaseDumper
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

    /** @phpstan-ignore-next-line */
    public function dump(
        Data $data,
        $output = null,
        array $extraDisplayOptions = [],
    ): string|null {
        $context = $this->context->get();

        if ($context === '') {
            return parent::dump(
                $data,
                $output,
                $extraDisplayOptions,
            );
        }

        parent::echoLine(
            '<pre><small>' . $context . '</small></pre>',
            0,
            '',
        );

        return parent::dump(
            $data,
            $output,
            $extraDisplayOptions,
        );
    }
}
