<?php

namespace App\Http\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Arr;

/**
 * @mixin ModelFilter
 */
trait SortableFilter
{
    public function sortBy(string $value)
    {
        $exploded = explode(',', $value);
        $column = Arr::get($exploded, 0);

        $order = Arr::get($exploded, 1, 'asc');

        if (in_array($column, $this->sortableColumns())) {
            return $this->orderBy($column, $order);
        }

        return $this;
    }

    abstract protected function sortableColumns(): array;
}
