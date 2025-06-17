# Sistema de Eventos UniALFA — Hackathon

Este projeto foi desenvolvido como solução para o Hackathon do 3º período do curso de Sistemas para Internet da Faculdade UniALFA. O objetivo é criar uma plataforma de gerenciamento e inscrição de eventos acadêmicos da instituição, dividida em três camadas: **Java**, **Node.js** e **PHP**, cada uma representando uma disciplina do curso.

---

## 🔷 Camada Java (Back Office)

Responsável por fornecer a interface gráfica para uso interno da equipe da UniALFA. Foi construída com Java Swing e segue os princípios da Programação Orientada a Objetos.

### Funcionalidades:
- Cadastro e edição de eventos
- Gerenciamento de palestrantes e coordenadores
- Interface gráfica com Java Swing
- Persistência em banco de dados MySQL via JDBC

### Tecnologias:
- Java 17+
- Swing (GUI)
- JDBC
- Maven
- MySQL

---

## 🟩 Camada Node.js (API RESTful)

Implementa a API responsável pela comunicação entre o banco de dados e o front-end PHP. Centraliza toda a lógica de CRUD dos dados.

### Funcionalidades:
- Endpoints para criação, leitura, atualização e exclusão de eventos, alunos, palestrantes, inscrições
- Middleware de autenticação com JWT
- Uso de migrations para controle de versão do banco
- Integração com MySQL via Knex.js

### Tecnologias:
- Node.js
- Express.js
- Knex.js
- MySQL
- JWT (autenticação)
- dotenv (configurações)

---

## 🟦 Camada PHP (Front-End Público)

Responsável pela interface pública acessada pelos alunos. Essa camada consome os dados da API Node.js para exibir os eventos e permitir inscrições.

### Funcionalidades:
- Página de listagem de eventos
- Formulário de inscrição de aluno
- Consumo da API Node.js via cURL
- Geração de certificados em PDF

### Tecnologias:
- PHP 8+
- HTML/CSS
- cURL
- Sessões e autenticação local
- Integração com API externa (Node)

---

## 🎯 Objetivo do Projeto

Criar um sistema funcional, simples e escalável para gerenciar e promover eventos acadêmicos da UniALFA, permitindo:

- Cadastro centralizado de eventos por coordenadores
- Inscrição rápida de alunos com geração de certificados
- Visualização e organização clara das informações
- Evitar conflitos de horário entre eventos
- Interface corporativa (Java) e pública (PHP)

---

## 🗂 Estrutura do Projeto

```
/java-backoffice          → Camada Java (Swing + JDBC)
/node-api                 → Camada Node.js (Express + JWT)
/php-frontend             → Camada PHP (páginas públicas)
```

## 👥 Equipe
Andrei Matos Costa
Eduardo Vergentino Malaquias
Guilherme Felipe De Morais
Josue Wellyngtton Marcal De Souza
Rafael Colombo Da Silva
Projeto desenvolvido por alunos do 3º período da Faculdade UniALFA como parte do Hackathon institucional.

