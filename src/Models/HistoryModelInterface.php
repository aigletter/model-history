<?php

namespace Aigletter\ModelHistory\Models;


use Illuminate\Foundation\Auth\User;

interface HistoryModelInterface
{
    /**
     * @return User
     */
    public function author();
}