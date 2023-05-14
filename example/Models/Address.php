<?php

namespace Example\Models;

use PaulinhoSupriano\Orm;

/**
 * Class Address
 * @package Example\Models
 */
class Address extends Orm
{
    /**
     * Address constructor.
     */
    public function __construct()
    {
        parent::__construct("tabela", ["campo_obrigatorio"]);
    }

    /**
     * @return $this
     */
    public function getUser(): Address
    {
        $this->user = (new User())->findById($this->campo_da_tabela)->data();
        return $this;
    }
}