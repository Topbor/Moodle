<?php

namespace App\Http\ModelFilters;

class UserFilter extends \EloquentFilter\ModelFilter
{
    use SortableFilter;

    public function search(string $value)
    {
        return $this->where('firstname', 'like', "%$value%")
        ->orWhere('lastname', 'like', "%$value%");
    }

    protected function sortableColumns(): array
    {
        return ['firstname'];
    }

}
