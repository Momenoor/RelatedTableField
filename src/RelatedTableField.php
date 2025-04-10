<?php

namespace Momenoor\RelatedTableField;

use Filament\Forms\Components\Field;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RelatedTableField extends Field
{

    protected string $view = 'filament::components.placeholder';

    protected ?array $columns = [];
    protected ?array $fields = [];

    public static function make(string $name): static
    {
        return parent::make($name);
    }

    /**
     * @throws \Exception
     */
    public function columns(array $columns): self
    {

        foreach ($columns as $column) {
            if (is_string($column)) {
                $this->columns[] = TextColumn::make($column);
                continue;
            }

            if (!$column instanceof Column) {
                throw new \InvalidArgumentException('Columns must be an instance of Filament Column');
            }

            $this->columns[] = $column;

        }
        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function form(array $fields): self
    {
        foreach ($fields as $field) {
            if (!$field instanceof Field) {
                throw new \InvalidArgumentException('Fields must be an instance of Filament\Field');
            }
            $this->fields[] = $field;
        }
        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getTable(): Table
    {
        return Table::make($this->getLivewire())
            ->columns($this->getColumns())
            ->recordAction(
                function () {
                    return [
                        DeleteAction::make(),
                        EditAction::make(),
                    ];
                }
            );
    }

    public function hydrateState(): void
    {
        if ($this->hasRelationship()) {
            $this->state = $this->getRelationship()
                ->getResults()
                ->map(fn($model) => $model->toArray())
                ->toArray();
        }
    }
}
