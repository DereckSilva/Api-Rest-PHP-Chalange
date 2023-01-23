<h1>REST API Challange</h1>

<p>O desafio tem como foco a criação de uma api para um CRUD simples no banco de dados</p>

<h1>Sistema CRON</h1>

<p>Sistema com o objetivo de executar comandos no servidor para baixar arquivos externos e popular a base de dados</p>

# Passo a passo do desenvolvimento:
<ul>
    <li>
        Criar/configurar o sistema cron para baixar a lista de produtos.
        <ol>
            <li>Configuração para baixar o arquivo com a lista de arquivos.</li>
            <li>Configuração para ler o .txt com os arquivos, pegando o nome de cada arquivo para baixar o .gz.</li>
            <li>Configuração para transformar o arquivo .gz em .txt.</li>
            <li>Configuração para extrair quantiade de 100 linhas do arquivo .txt transformado.</li>
        </ol>
    </li>
    <li>
    Preparar migrations para definir a base de dados.
        <ol>
            <li>Configuração de campos conforme base de dados do README.</li>
            <li>Preparação de service para persistir os dados na migration criada.</li>
        </ol>
    </li>
    <li>Desenvolver métodos da REST API + Testes
        <ol>
            <li>
                Desenvolvimento de API com os Testes
            </li>
            <li>
                Testes desenvolvidos sem alterar a base de dados
            </li>
            <li>Configuração de middleware para verificação de código passado como parâmetro.</li>
            <li>Configuração de controller para verbos PUT e DELETE</li>
        </ol>
    </li>
</ul>

# Pré-Requisitos

Para rodar o projeto localmente será necessário as seguintes instalações na sua máquina:

<ul><li><a href="#git">Git - Versão: 2.25.1</a></li>
<li><a href="#docker">Docker - Versão: 20.10.12</a></li>
</ul>

Antes de começar, instale o git na sua máquina e clone o repositório:

<ul><li>git clone https://github.com/DereckSilva/Api-Rest-PHP-Chalange</li></ul>

Instale o <a href="https://docs.docker.com/get-docker/">Docker</a> na sua máquina (necessário usar o docker via shell/bash) 

Para inicializar o projeto localmente é necessário rodar o seguite comando:

<ul><li>./vendor/bin/sail up -d</li></ul>

O sistema será inicializado por padrão na porta 80 do navegador, porém pode ser alterado via docker-compose.yml.

### Tecnologias
<span id="doc"></span>
<h4>As seguintes ferramentas foram usadas na construção do projeto:</h4>

- [Docker](https://docs.docker.com/) <span id="docker"></span>
- [Laravel](https://laravel.com/)
- [Git](https://git-scm.com)<span id="git"></span>

# Autor
<img src="https://avatars.githubusercontent.com/u/70153036?s=150&u=8e03e272b1a884652e7db30666f99a0e01b689c0&v=4">

Feito com ❤️ por Dereck Silva 👋🏾 Entre em contato!

[![Linkedin Badge](https://img.shields.io/badge/-Dereck-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/dereck-silva/)](https://www.linkedin.com/in/dereck-silva/) 
[![Gmail Badge](https://img.shields.io/badge/-viniciusdereck39@gmail.com-c14438?style=flat-square&logo=Gmail&logoColor=white&link=mailto:viniciusdereck39@gmail.com)](mailto:viniciusdereck39@gmail.com)
