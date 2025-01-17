<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\Column;

class UserColumn extends Column
{
    protected string $view = 'tables.columns.user-column';

    public bool $redirectOnClick = true;

    public function redirectOnClick(bool $redirectOnClick = true): static
    {
        $this->redirectOnClick = $redirectOnClick;

        return $this;
    }
}
