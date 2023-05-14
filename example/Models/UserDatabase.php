<?php

namespace Example\Models;

use PaulinhoSupriano\Orm;

/**
 * Class User
 * @package Example\Models
 */
class UserDatabase extends Orm
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("nome_da_tabela", ["campo_um_obrigario", "campo_dois_obrigatorio"], "user_id", false, DATABASE);
    }
}