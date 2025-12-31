<?php

declare(strict_types=1);

namespace BeastBytes\Mermaid\Packet;

use RuntimeException;

final class Field
{
    private ?int $end = null;
    private int $length = 1;
    private ?int $start = null;

    public function __construct(private readonly string $description)
    {
    }

    public function start(int $start): self
    {
        if ($start < 0) {
            throw new RuntimeException('start must be >= 0');
        }

        $this->start = $start;
        return $this;
    }

    public function end(int $end): self
    {
        if ($this->start === null) {
            throw new RuntimeException('end() can only be called after start()');
        }
        if ($end < $this->start) {
            throw new RuntimeException('end must be >= start');
        }

        $this->end = $end;
        return $this;
    }

    public function length(int $length): self
    {
        if (is_int($this->end)) {
            throw new RuntimeException('Cannot call length(); end() already called');
        }
        if ($length < 1) {
            throw new RuntimeException('length must be >= 1');
        }

        $this->length = $length;
        return $this;
    }

    /** @internal */
    public function render(int $position): string
    {
        if (is_int($this->start)) {
            if ($this->start < $position) {
                throw new RuntimeException(sprintf(
                    'Invalid start value; must be >= current position. %s given, current position = %s',
                    $this->start,
                    $position
                ));
            }

            $field = $this->start;

            if (is_int($this->end) && $this->end > $this->start) {
                $field .= '-' . $this->end;
            } else {
                $this->end = $this->start + $this->length - 1;
                    
                if ($this->length > 1) {
                    $field .= '-' . $this->end;
                }
            }
        } else {
            $field = '+' . $this->length;
            $this->end = $position + $this->length - 1;
        }

        return $field . ': "' . $this->description . '"';
    }

    /** @internal */
    public function getPosition(): ?int
    {
        return $this->end + 1;
    }
}