# Camada Java — Back Office (Eventos UniALFA)

A camada Java representa o sistema de Back Office da solução desenvolvida no Hackathon UniALFA. Seu objetivo é fornecer uma interface gráfica local para que a equipe administrativa possa gerenciar eventos, palestrantes e coordenadores da instituição.

A aplicação foi desenvolvida em Java com base no paradigma de **Programação Orientada a Objetos**, utilizando a biblioteca **Java Swing** para interface gráfica, **JDBC** para conexão com banco de dados **MySQL** e **Maven** como sistema de build.

---

## 📁 Estrutura de pacotes

A organização do projeto segue a separação por responsabilidades, conforme boas práticas de arquitetura em camadas.

```
unialfa.hotsite
├── dao              // Camada de acesso a dados (Data Access Object)
├── gui              // Interfaces gráficas (Swing)
├── model            // Classes de domínio (Entidades)
├── service          // Lógica de negócio
└── util             // Utilitários auxiliares (ex: GuiUtil)
```

---

## 📦 `model/`

As classes dentro deste pacote representam as **entidades do domínio** do sistema. Cada classe reflete uma tabela no banco de dados e contém:

- Atributos privados
- Construtores
- Métodos getters e setters

Entidades presentes:

- `Evento`: representa um evento da instituição.
- `Palestrante`: contém nome, minicurrículo, tema e URL da foto.
- `Coordenador`: identifica o coordenador responsável e seu curso.

---

## 📦 `dao/`

Camada responsável pela **persistência dos dados** no banco MySQL. Utiliza JDBC puro. Cada DAO executa comandos SQL e oferece métodos para:

- `salvar()`: insere novo registro
- `listar()`: recupera registros
- `atualizar()`: atualiza informações
- `excluir()`: remove registros

Classes principais:

- `EventoDao`
- `PalestranteDao`
- `CoordenadorDao`

---

## 📦 `service/`

Contém a **camada de regras de negócio**, responsável por intermediar a comunicação entre as telas (GUI) e os DAO. Também pode aplicar validações e transformações nos dados.

- `EventoService`: coordena operações relacionadas a eventos.
- `PalestranteService`: gerencia dados dos palestrantes.
- `CoordenadorService`: responsável pelas ações de coordenadores.

Exemplo de lógica adicional: antes de salvar um evento, a `EventoService` pode validar se a data e hora são válidas.

---

## 📦 `gui/`

Implementa as interfaces gráficas do sistema com **Java Swing**. As telas utilizam elementos como:

- `JFrame`: janela principal
- `JPanel`: painel de layout
- `JLabel`: rótulos de texto
- `JTextField` e `JTextArea`: campos de entrada
- `JComboBox`: seleção de coordenadores
- `JTable`: exibição de registros
- `JButton`: ações como salvar, atualizar, excluir

Principais telas:

- `TelaPrincipalGui`: tela inicial com menu de navegação
- `EventoGui`: cadastro e listagem de eventos
- `PalestranteGui`: gerenciamento de palestrantes
- `CoordenadorGui`: gerenciamento de coordenadores

Cada tela chama os métodos da respectiva `Service`, que por sua vez utiliza os `DAO`.

---

## 📦 `util/`

Contém a interface `GuiUtil`, que agrupa métodos auxiliares usados pelas telas para evitar repetição de código. Por exemplo:

- Centralizar janelas
- Configurar botões
- Aplicar formatações

---

## 🔌 Conexão com o banco de dados

A conexão é feita por meio da classe `Conexao`, que usa `DriverManager.getConnection()` com as seguintes configurações:

- Banco: MySQL
- Driver: `mysql-connector-java`
- Configurado via `pom.xml` (Maven)

Trecho do `pom.xml`:

```xml
<dependency>
  <groupId>mysql</groupId>
  <artifactId>mysql-connector-java</artifactId>
  <version>8.0.33</version>
</dependency>
```

A string de conexão inclui: `host`, `porta`, `nome do banco`, `usuário` e `senha`.

---

## 🧪 Funcionalidades disponíveis

- Cadastro de eventos
- Listagem de eventos em tabela
- Edição e exclusão de eventos
- Cadastro e edição de palestrantes vinculados aos eventos
- Validação básica de campos (ex: horário de início anterior ao de término)

---

## 🛠 Tecnologias utilizadas

- Swing (GUI)
- JDBC
- MySQL
- Maven
