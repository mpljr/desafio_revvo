# Desafio Revvo - Plataforma de Cursos

## Desenvolvedor
- **Nome:** Manoel Lima
- **E-mail:** manupljr@gmail.com
- **LinkedIn:** [https://www.linkedin.com/in/manoellima/](https://www.linkedin.com/in/manoellima/)

## Sobre o Projeto
Plataforma de cursos online desenvolvida como parte do desafio técnico da Revvo. O projeto implementa um sistema de gerenciamento de cursos com slideshow dinâmico e interface responsiva.

## Tecnologias Utilizadas

### Front-end
- HTML5
- SASS/CSS3
- JavaScript (Vanilla)
- Gulp (Automatização)

### Back-end
- PHP 8.2 (sem frameworks)
- MySQL 8.0
- Docker & Docker Compose

## Funcionalidades
- CRUD completo de cursos
- Gerenciamento de slideshow
- Modal de primeiro acesso
- Interface responsiva
- Automatização de tarefas front-end

## Estrutura do Projeto
```
.
├── docker-compose.yml
├── Dockerfile
├── gulpfile.js
├── package.json
└── src/
    ├── api/
    │   ├── courses/
    │   └── slideshow/
    ├── assets/
    │   ├── css/
    │   ├── js/
    │   └── scss/
    ├── config/
    ├── models/
    └── index.php
```

## Instalação e Execução

1. Clone o repositório:
```bash
git clone https://github.com/mpljr/desafio_revvo.git
cd desafio_revvo
```

2. Instale as dependências do Node.js:
```bash
npm install
```

3. Inicie os containers Docker:
```bash
docker-compose up -d
```

4. Compile os assets:
```bash
npm run build
```

5. Acesse a aplicação:
```
http://localhost:8080
```

## Desenvolvimento

Para iniciar o ambiente de desenvolvimento com hot-reload:

```bash
npm run dev
```

## Licença
Este projeto está sob a licença MIT.