## Sobre Orm

###### ORM is a tool that uses control that enables the manipulation of objects through mapping between object-oriented systems and relational databases. The Orm is a persistent abstraction component of your database for which PDO has prepared instructions to perform common routines such as recording, reading, editing, and removing data.

ORM é uma ferramenta que utiliza mecanismos que possibilitam a manipulação dos objetos por meio do mapeamento entre sistemas orientados a objetos e banco de dados relacionais. 

A camada de dados é um componente de abstração persistente do seu banco de dados para o qual o PDO preparou instruções para executar rotinas comuns, como registro, leitura, edição e remoção de dados.


### Destaques

- Easy to set up (Fácil de configurar)
- Total CRUD abstraction (Abstração total do CRUD)
- Create safe models (Crie modelos seguros)
- Composer ready (Pronto para o composer)
- PSR-2 compliant (Compatível com PSR-2)

## Instalação 

A camada de dados está disponível via Composer:

```bash
"paulinhosupriano/orm": "1.0.*"
```

ou 

```bash
composer require paulinhosupriano/orm
```

## Documentação

###### For details on how to use the Orm, see the sample folder with details in the component directory

Para mais detalhes sobre como usar o Orm, veja a pasta de exemplo com detalhes no diretório do componente

#### conexão

###### To begin using the Orm, you need to connect to the database (MariaDB / MySql). For more connections [PDO connections manual on PHP.net](https://www.php.net/manual/pt_BR/pdo.drivers.php)

Para começar a usar o Orm precisamos de uma conexão com o seu banco de dados. Para ver as conexões possíveis
acesse o [manual de conexões do PDO em PHP.net](https://www.php.net/manual/pt_BR/pdo.drivers.php)

```php
const ORM_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "banco_de_dados",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];
```

#### seu modelo

###### The Orm is based on an MVC structure with the Layer Super Type and Active Record design patterns. Soon to consume it is necessary to create the model of your table and inherit the Orm.

O Orm é baseado em uma estrutura MVC com os padrões de projeto Layer Super Type e Active Record. Logo para
consumir é necessário criar o modelo de sua tabela e herdar o Orm.

```php
<?php

class User extends Orm
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        //string "TABLE_NAME", array ["REQUIRED_FIELD_1", "REQUIRED_FIELD_2"], string "PRIMARY_KEY", bool "TIMESTAMPS" 
        parent::__construct("tabela", ["campo_um_obrigatorio", "campo_dois_obrigatorio"]);
    }
}
```

#### find

```php
<?php

use Example\Models\User;

$model = new User();

//find all users
$users = $model->find()->fetch(true);

//find all users limit 2
$users = $model->find()->limit(2)->fetch(true);

//find all users limit 2 offset 2
$users = $model->find()->limit(2)->offset(2)->fetch(true);

//find all users limit 2 offset 2 order by field ASC
$users = $model->find()->limit(2)->offset(2)->order("campo_da_tabela ASC")->fetch(true);

// find all users with in operator
$users = $model->find()->in("id", [1, 2, 3])->fetch(true);

//looping users
foreach ($users as $user) {
    echo $user->campo_da_tabela;
}

//find one user by condition
$user = $model->find("campo_da_tabela = :name", "name=Paulinho")->fetch();
echo $user->campo_da_tabela;

//find one user by two conditions
$user = $model->find("campo_da_tabela = :name AND last_name = :last", "name=Paulinho&last=Supriano")->fetch();
echo $user->campo_da_tabela . " " . $user->first_last;

//find one user by condition and with in operator
$user = $model->find("campo_da_tabela = :name", "name=Paulinho")->in("last_name",["Menezes", "Sampaio"])->fetch(true);

foreach ($users as $user) {
    echo $user->campo_da_tabela . " " . $user->first_last;
}
```

#### findById

```php
<?php

use Example\Models\User;

$model = new User();
$user = $model->findById(2);
echo $user->campo_da_tabela;
```

#### secure params

###### See example find_example.php and model classes

Consulte exemplo find_example.php e classes modelo

```php
<?php

$params = http_build_query(["name" => "devSupriano"]);
$company = (new Company())->find("name = :name", $params);
var_dump($company, $company->fetch());
```

#### join method

###### See example find_example.php and model classes

Consulte exemplo find_example.php e classes modelo

```php
<?php

$addresses = new Address();
$address = $addresses->findById(22);
//get user data to this->user->[all data]
$address->user();
var_dump($address);
```

#### count

```php
<?php

use Example\Models\User;

$model = new User();
$count = $model->find()->count();
```

#### save create

```php
<?php

use Example\Models\User;

$user = new User();
$user->campo_da_tabela = "Paulinho";
$user->last_name = "Supriano";
$userId = $user->save();

// ou 
//$user = new User();
//$user->setData([
//    'campo_da_tabela' =>'Paulinho',
//    'last_name' => 'Supriano'
//]);
//$userId = $user->save();


```

#### save update

```php
<?php

use Example\Models\User;

$user = (new User())->findById(2);
$user->campo_da_tabela = "Paulinho";
$userId = $user->save();
```

#### destroy

```php
<?php

use Example\Models\User;

$user = (new User())->findById(2);
$user->destroy();
```

#### fail

```php
<?php

use Example\Models\User;

$user = (new User())->findById(2);
if($user->fail()){
    echo $user->fail()->getMessage();
}
```

#### custom data method

````php
<?php

class User{

    public function fullName(): string 
    {
        return "{$this->campo_da_tabela} {$this->last_name}";
    }
    
    public function document(): string
    {
        return "Restrict";
    }
}

echo $this->full_name; //Paulinho Supriano
echo $this->document; //Restrict
```` 


## Support

###### Security: If you discover any security related issues, please email paulinhosupriano@gmail.com instead of using the issue tracker.

Se você descobrir algum problema relacionado à segurança, envie um e-mail para paulinhosupriano@gmail.com em vez de usar o rastreador de problemas.

Thank you


## License

The MIT License (MIT). Please see [License File](https://github.com/paulinhosupriano/orm/blob/master/LICENSE) for more
information.
