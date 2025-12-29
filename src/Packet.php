<?php

declare(strict_types=1);

namespace BeastBytes\Mermaid\Packet;

use BeastBytes\Mermaid\Diagram;

final class Packet extends Diagram
{
    private const string TYPE = 'packet';

    /**
     * @var Field[] $fields
     */
    private array $fields = [];

    public function addField(...$field): self
    {
        $new = clone $this;
        $new->fields = [...$this->fields, ...$field];
        return $new;
    }

    public function withField(...$field): self
    {
        $new = clone $this;
        $new->fields = $field;
        return $new;
    }

    protected function renderDiagram(): string
    {
        $output = [];
        $position = 0;

        $output[] = self::TYPE;

        foreach ($this->fields as $field) {
            $output[] = $field->render($position);
            $position = $field->getPosition();
        }

        return implode("\n", $output);
    }
}