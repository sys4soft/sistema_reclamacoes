# SISTEMA DE RECLAMAÇÕES

## 1. Introdução
O sistema vai permitir que um cliente (mesmo desconhecido) possa apresentar
uma reclamação sobre um produto ou serviço.

O cliente entra numa página web e preenche um formulário com os seguintes campos:

- Email * (obrigatório)
- Nome * (facultativo)
- Selecionar a área de reclamação * (obrigatório) - select de html com opções
- Área de texto para a reclamação * (obrigatório)
- Upload de ficheiros (max 3) (facultativo)
- Enviar (botão)

## back-end
- O back-end deve receber os dados do formulário e guardar numa base de dados
- Ao submeter o formulário, vai ser enviado um email para o cliente, contendo a sua reclação e um número de referência e um link com um purl (personal url) para que o cliente possa consultar o estado da sua reclamação.

Paralelamente, o sistema vai ter um conjunto de usuários com diferentes perfis:
- Administrador - pode consultar todas as reclamações e alterar o estado de cada uma e tem a possibilidade de responder ao cliente e fazer a gestão da plataforma:

    - gestão de utilizadores
    - eliminar reclamações
    - atribuir reclamações a outros utilizadores
    - etc

# Fluxo

- o cliente submete a reclamação.

    - se o email não existe na base de dados, é criado um novo registo de cliente.

    - vai permitir ter dados de clientes desconhecidos.
    - vai permitir fazer o restreio de reclamações por cliente.


# banco de dados
- clients
    - id (PK)
    - email (varchar 100)
    - nome (varchar 100) / NULL
    - created_at (datetime)

- complaints
    - id (PK)
    - client_id (FK)
    - area (varchar 100)
    - message (text)
    - attachments (json) / NULL
    - status (varchar 50)
    - created_at (datetime)
    - updated_at (datetime) / NULL
    - deleted_at (datetime) / NULL

- users
    - id (PK)
    - email / username (varchar 100)
    - password (varchar 200)
    - role (varchar 50)
    - created_at (datetime)
    - updated_at (datetime) / NULL
    - deleted_at (datetime) / NULL

- user_complaints
    - id (PK)
    - user_id (FK)
    - complaint_id (FK)
    - created_at (datetime)
    - updated_at (datetime) / NULL
    - deleted_at (datetime) / NULL

# atenção:
- a reclamação, após ser submetida, não vai poder ser editada.
- as respostas dos colaboradores vão poder ser editadas até que a reclamação seja fechada.
- são os colaboradores que têm a responsabilidade de fechar as reclamações e de ir alterando o estado das mesmas.
- Sempre que acontecer uma alteração no estado da reclamação, o cliente vai receber um email com a atualização. Nesse email, vai um purl (personal url) para que o cliente possa consultar o estado da sua reclamação.
- ao visualizar a reclamação, e as respostas subsequentes, o cliente vai poder ver o estado da reclamação e as respostas dos colaboradores. Vai ver o processo em modo de forum.