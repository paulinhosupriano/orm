<?php

namespace Example\Models;

use PaulinhoSupriano\Orm;

class Company extends Orm
{
    public function __construct()
    {
        parent::__construct("tabela", ["campo_um_obrigatorio", "campo_dois_obrigatorio"]);
    }
}