<?php

namespace Example\Models;

use PaulinhoSupriano\Orm;

/**
 * Class User
 * @package Example\Models
 */
class User extends Orm
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("tabela", ["campo_um_obrigatorio", "campo_dois_obrigatorio"]);
    }

    public function fullName()
    {
        return "{$this->campo_da_tabela_um} {$this->campo_da_tabela_dois}";
    }
}