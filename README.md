![Newsletter HUB Logo](resources/js/assets/logo_web.png)

---

# Newsletter UTFPR-FB 📰

Um **HUB de newsletters** para autores acadêmicos e universitários compartilharem conteúdo de qualidade de forma simples, dinâmica e personalizada.

---

## 🚀 Visão Geral

Neste sistema, autores se cadastram e utilizam uma ferramenta baseada em blocos (nós) para criar suas newsletters:

* Cada **bloco** contém:

  * 🎯 Cabeçalho
  * 🏷️ Título
  * 🖼️ Imagem
  * 📝 Conteúdo em Markdown
* Possibilidade de incluir novos tipos de nós para expandir funcionalidades.
* Preview em tempo real da newsletter antes do envio.

Para o(a) **assinante**:

* Sign‑in simplificado por **e-mail** (login mágico com código de acesso).
* Alternativa de **senha** configurável na área de perfil.
* Escolha de autores e assinaturas personalizadas.

Para os **administradores**:

* Revisão manual de conteúdos antes de aprovação.
* No futuro: pipeline de **IA** (e.g. TransformersPHP) para avaliação automática de textos.

## 🎯 Missão

> **Democratizar o acesso a conteúdos de qualidade** de acadêmicos e universitários, incentivando o hábito de leitura em um mundo cada vez mais dominado por conteúdo automatizado e sintético.

## 🛠️ Tecnologias Utilizadas

| Camada             | Ferramenta / Biblioteca        |
| ------------------ | ------------------------------ |
| Backend            | LIVT Stack (Node.js, LARAVEL?) |
| Frontend           | (Vue/React?)                   |
| Banco de Dados     | MySQL                          |
| Autenticação       | Email Magic Link + JWT         |
| Editor de Conteúdo | Markdown + Blocos Dinâmicos    |
| Containerização    | Docker                         |

> **Observação:** o projeto segue a **LIVT Stack**, com banco relacional MySQL.

## 🚢 Como Rodar em Docker

1. **Construir a imagem**

   ```bash
   docker build -t newsletter .
   ```
2. **Iniciar o container**

   ```bash
   docker run -it newsletter bash
   ```

> Dentro do container, instale dependências e execute `npm install` / `composer install` conforme a stack.

## 👨🏽‍💻👩🏼‍💻 Equipe de Desenvolvimento

| ![Vitor Ferreira](https://github.com/vitorferreiracode.png) | ![Felipe Kurt](https://github.com/kzrtt.png) |
| :---------------------------------------------------------: | :------------------------------------------: |
|                      **Vitor Ferreira**                     |                **Felipe Kurt**               |

---

## 📈 Roadmap & Funcionalidades Futuras

* [ ] Pipeline de IA para revisão de conteúdo (TransformersPHP).
* [ ] Novos tipos de blocos (vídeo, citações, quizzes).
* [ ] Temas personalizados e identidade de marca para autores.
* [ ] Estatísticas de engajamento e métricas de leitura.

---

##### © 2025 UTFPR-FB
