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

# Executar o projeto 

Instale o <a href="https://docs.docker.com/get-docker/">Docker</a> na sua máquina (necessário usar o docker via shell/bash) 

Rode o seguinte comando para ter o laravel sail na sua máquina

<ul><li>curl -s "https://laravel.build/example-app?with=mysql,redis" | bash</li></ul>

Após a instalação remova as pastas de <b>app, bootstrap, config, database, lang, public, resources, routes, storage e tests</b>. Faça o clone do projeto com o seguinte comando.

<ul><li>git clone https://github.com/DereckSilva/Api-Rest-PHP-Chalange</li></ul>

Após a clonagem do repositório, pegue as pastas de <b>app, bootstrap, config, database, lang, public, resources, routes, storage e tests</b> do repositório clonado e adicione no path do laravel sail.

Para inicializar o projeto localmente é necessário rodar o seguite comando:

Inicialixar o container:

<ul><li>./vendor/bin/sail up -d </li></ul>

O sistema será inicializado por padrão na porta 80 do navegador, porém pode ser alterado via docker-compose.yml.

Para acessar o container rode o comando:

<ul><li>./vendor/bin/sail root-shell </li></ul>

No container executar os seguintes comandos:

<ul>
    <li> apt-get update </li>
    <li> apt-get install nano </li>
    <li> apt-get install systemctl </li>
    <li> apt-get install cron </li>
    <li> systemctl enable cron</li>
</ul>

Saia do container com o comando:

<ul><li>exit</li></ul>

Entre no container novamente como usuário normal, executando o comando:

<ul><li>./vendor/bin/sail shell </li></ul>

Execute o comando:

<ul><li> crontab -e  </li></ul>

Colar o seguinte comando no arquivo crontab:

<ul><li>0 10 * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1</li></ul>

Certifique-se do cron estar executando no servidor:

<ul><li>system status cron</li></ul>

Caso não esteja executando, execute o comando:

<ul><li>system ctl start cron</li></ul>

Após colar o comano, sai do terminal e a aguarde a execução do cron job.

Após a execução do cron job pode utilizar a API.

### Tecnologias
<span id="doc"></span>
<h4>As seguintes ferramentas foram utilizadas na construção do projeto:</h4>

- [Docker](https://docs.docker.com/) <span id="docker"></span>
- [Laravel](https://laravel.com/)
- [Git](https://git-scm.com)<span id="git"></span>

# Autor
<img src="https://avatars.githubusercontent.com/u/70153036?s=150&u=8e03e272b1a884652e7db30666f99a0e01b689c0&v=4">

Feito com ❤️ por Dereck Silva 👋🏾 Entre em contato!

[![Linkedin Badge](https://img.shields.io/badge/-Dereck-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/dereck-silva/)](https://www.linkedin.com/in/dereck-silva/) 
[![Gmail Badge](https://img.shields.io/badge/-viniciusdereck39@gmail.com-c14438?style=flat-square&logo=Gmail&logoColor=white&link=mailto:viniciusdereck39@gmail.com)](mailto:viniciusdereck39@gmail.com)
