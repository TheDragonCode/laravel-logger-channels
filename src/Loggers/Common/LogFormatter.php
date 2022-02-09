<?php

namespace Helldar\LaravelLoggerChannels\Loggers\Common;

use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;

class LogFormatter
{
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter($this->formatter());
        }
    }

    protected function formatter(): FormatterInterface
    {
        return new LineFormatter(null, $this->dateFormat, true, true);
    }
}
