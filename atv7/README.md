# Introdução

API para manipular uma lista de usuários.
Todos os registros são salvos em um arquivo TXT.

# Ações

**Listar Usuários**

* URL
    ```http
    GET /api/usuario/list.php
    ```
---

**Criar Usuários**

* URL
    ```http
    POST /api/usuario/create.php
    ```

* Corpo da requisição:

    | Tipo |
    | :--- |
    | `JSON` |

    | Parâmetros | Type | Descrição |
    | :--- | :--- | :--- |
    | `nome` | `string` | **Obrigatório**. Nome do usuário |
    | `sobrenome` | `string` | **Obrigatório**. Sobrenome do usuário |
    | `email` | `string` | **Obrigatório**. E-mail do usuário |
    | `telefone` | `int` | Telefone do usuário |

* Exemplo de chamada
    ```http
    {
        "nome": "Usuario",
        "sobrenome": "Teste",
        "email": "usuario@email.com",
        "telefone": "19999999999"
    }
    ```
---

**Editar Usuários**

* URL
    ```http
    PUT|PATCH|POST /api/usuario/update.php
    ```

* Corpo da requisição:

    | Tipo |
    | :--- |
    | `JSON` |

    | Parâmetros | Type | Descrição |
    | :--- | :--- | :--- |
    | `nome` | `string` | **Obrigatório**. Nome do usuário |
    | `sobrenome` | `string` | **Obrigatório**. Sobrenome do usuário |
    | `email` | `string` | **Obrigatório**. E-mail do usuário |
    | `telefone` | `int` | Telefone do usuário |

* Exemplo de chamada
    ```http
    {
        "nome": "Usuario",
        "sobrenome": "Teste",
        "email": "usuario@email.com",
        "telefone": "19999999999"
    }
    ```
---

**Deletar Usuários**
* URL
    ```http
    DELETE|POST /api/usuario/delete.php
    ```
* Corpo da requisição:

    | Tipo |
    | :--- |
    | `JSON` |

    | Parâmetros | Type | Descrição |
    | :--- | :--- | :--- |
    | `email` | `string` | **Obrigatório**. E-mail do usuário |
    
* Exemplo de chamada
    ```http
    {
        "email": "usuario@email.com"
    }
    ```

## Responses

A API retornará a seguinte estrutura:

```javascript
{
  "message" : string,
  "data"    : array     // Se houver dados
}
```

## Response - Status

A API pode retornar os seguintes status:

| Status | Description |
| :--- | :--- |
| 200 | `OK` |
| 201 | `CREATED` |
| 400 | `BAD REQUEST` |
| 404 | `NOT FOUND` |
| 500 | `INTERNAL SERVER ERROR` |