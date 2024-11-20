[JAVASCRIPT__BADGE]: https://img.shields.io/badge/Javascript-000?style=for-the-badge&logo=javascript

<h1 align="center" style="font-weight: bold;">JundTask</h1>

![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![javascript][JAVASCRIPT__BADGE]

<p align="center">
 <a href="#about">Sobre</a> • 
 <a href="#started">Preparação para a inicialização do projeto</a> • 
 <a href="#initializing">Inicializando o projeto</a> • 
 <a href="#colab">Autores</a> •
 <a href="#contribute">Como citar o projeto</a> •
 <a href="#apendice">Apendice</a>
</p>

<p align="center">
    <img src=".github/logo.png" alt="Image Example" width="700px">
</p>
<h2 id="about">📌 Sobre</h2>

 A plataforma desenvolvida tem como objetivo facilitar a conexão entre trabalhadores autônomos e clientes na área de Jundiaí, promovendo os serviços desses profissionais de maneira prática e acessível. A interface é projetada para ser intuitiva, permitindo que tanto trabalhadores quanto clientes naveguem facilmente e encontrem o que precisam, auxiliando numa experiência simplificada para ambos os tipos de usuário.


<h2 id="started">🚀 Preparação para a inicialização do projeto</h2>
A inicialização do JundTask é simples, mas é importante garantir que você atenda aos requisitos mínimos para evitar erros. Certifique-se de que está utilizando uma versão igual ou superior às indicadas abaixo.

<h3>Pré requisitos</h3>

<table>
 <tr>
  <td>HTML</td>
  <td>CSS</td>
  <td>Bootstrap</td>
  <td>JavaScript</td>
  <td>PHP</td>
  <td>Xamp</td>
 </tr>
 <tr>
  <td>HTML5</td>
  <td>CSS3</td>
  <td>5.3</td>
  <td>1.8</td>
  <td>8.1.25</td>
  <td>8.1.25</td>
</tr>
</table>

<h3>Clonando o projeto</h3>

A clonagem do projeto pode ser feita apenas digitando a linha de código abaixou ou baixando o projeto.

```
git clone https://github.com/Gineris/siteatualizado.git
```

<h2 id="initializing">Inicializando o projeto</h2>

<ol>
  <li>
    <strong>Inicie o XAMPP</strong> e ative o servidor Apache e o banco de dados MySQL.
  </li>
  <li>
    <strong>Importe o banco de dados:</strong>
    <ul>
      <li>O arquivo do banco de dados está disponível no repositório.</li>
      <li>Use o phpMyAdmin para importar o arquivo.</li>
    </ul>
  </li>
  <li>
    <strong>Mova o repositório para a pasta <code>htdocs</code>:</strong>
    <ul>
      <li>Coloque a pasta clonada em <code>C:\xampp\htdocs</code>.</li>
    </ul>
  </li>
  <li>
    <strong>Abra o navegador e acesse o projeto:</strong>
    <ul>
      <li>Digite <code>http://localhost/siteatualizado</code> no navegador.</li>
    </ul>
  </li>
</ol>

<p>Você verá a seguinte tela inicial:</p>

<p align="center">
  <img src=".github/fttelainicial.png" alt="Tela Inicial" width="700px">
</p>

<h3>Criando uma conta</h3>
<p>
  Para usar todas as funcionalidades do site, você precisa estar logado. Caso ainda não tenha uma conta:
</p>
<ol>
  <li>Clique no botão <strong>Login</strong>.</li>
  <li>Escolha a opção <strong>Criar Conta</strong>.</li>
  <li>Preencha os dados, é fácil e rápido!</li>
</ol>
<p>
  Após o login, você terá acesso total às funcionalidades do site.
</p>

<h2 id="colab">🤝 Autores</h2>

Estes são os autores, que fizeram a parte escrita e prática do projeto

<table>
  <tr>
    <td align="center">
        <img src=".github/ftGuilherme.jpg" width="100px;" alt="Guilherme Campos Profile Picture"/><br>
        <sub>
          <b>Guilherme Campos</b>
        </sub>
    </td>
    <td align="center">
        <img src=".github/ftMateus.jpg" width="100px;" alt="Mateus Costa Profile Picture"/><br>
        <sub>
          <b>Mateus Costa</b>
        </sub>
    </td>
    <td align="center">   
        <img src=".github/ftGiovana.jpg" width="100px;" alt="Giovana Gouveia Profile Picture "/><br>
        <sub>
          <b>Giovana Gouveia</b>
        </sub>
    </td>
  </tr>
</table>
<h2 id="contribute">📫 Como citar o projeto</h2>

Se você utilizar este projeto em sua pesquisa, artigo, ou trabalho, por favor, cite-o da seguinte forma:

CAMPOS, Guilherme; COSTA, Mateus; GOUVEIA, Giovana. <strong>Implementação de uma plataforma digital na divulgação de trabalhadores autonômos na região de Jundiaí</strong>. GitHub, ano. Disponível em: <https://github.com/Gineris/siteatualizado>. Acesso em: dia mês ano.

<h2 id="apendice">📫 Apendice - Pesquisa de campo para a implementação da plataforma</h2>

## Seção: Informações Pessoais
<form>
    <p><strong>1. Qual é sua idade?</strong></p>
    <label><input type="radio" name="idade" value="14-17"> 14 a 17</label><br>
    <label><input type="radio" name="idade" value="18-20"> 18 a 20</label><br>
    <label><input type="radio" name="idade" value="21-30"> 21 a 30</label><br>
    <label><input type="radio" name="idade" value="31-40"> 31 a 40</label><br>
    <label><input type="radio" name="idade" value="mais-40"> Mais de 40 anos</label><br>

   <p><strong>2. Qual gênero você se identifica?</strong></p>
    <label><input type="radio" name="genero" value="feminino"> Feminino</label><br>
    <label><input type="radio" name="genero" value="masculino"> Masculino</label><br>
    <label><input type="radio" name="genero" value="nao-binario"> Não-binário</label><br>
    <label><input type="radio" name="genero" value="prefiro-nao-dizer"> Prefiro não dizer</label><br>
    <label>Outro: <input type="text" name="genero-outro"></label><br>

   <p><strong>3. Em qual cidade da região de Jundiaí você mora?</strong></p>
    <label><input type="radio" name="cidade" value="campo-limpo-paulista"> Campo Limpo Paulista</label><br>
    <label><input type="radio" name="cidade" value="varzea-paulista"> Várzea Paulista</label><br>
    <label><input type="radio" name="cidade" value="jundiai"> Jundiaí</label><br>
    <label><input type="radio" name="cidade" value="jarinu"> Jarinu</label><br>
    <label>Outro: <input type="text" name="cidade-outro"></label><br>

   <p><strong>4. Você faz ou já fez algum trabalho autônomo?</strong></p>
    <label><input type="radio" name="trabalho-autonomo" value="sim"> Sim</label><br>
    <label><input type="radio" name="trabalho-autonomo" value="nao"> Não (Pular para a seção Cliente)</label><br>
</form>

## Seção: Trabalhador Autônomo
<form>
    <p><strong>6. Escolha a categoria dos serviços que você realiza:</strong></p>
    <label><input type="checkbox" name="categoria" value="servicos-domesticos"> Serviços Domésticos</label><br>
    <label><input type="checkbox" name="categoria" value="reparos-manutencao"> Reparos e Manutenção</label><br>
    <label><input type="checkbox" name="categoria" value="saude-beleza"> Saúde e Beleza</label><br>
    <label><input type="checkbox" name="categoria" value="educacao-aulas"> Educação e Aulas Particulares</label><br>
    <label><input type="checkbox" name="categoria" value="eventos-festas"> Serviços para Eventos e Festas</label><br>
    <label><input type="checkbox" name="categoria" value="servicos-automotivos"> Serviços Automotivos</label><br>
    <label><input type="checkbox" name="categoria" value="servicos-tecnologicos"> Serviços Tecnológicos</label><br>
    <label><input type="checkbox" name="categoria" value="consultoria-assessoria"> Consultoria e Assessoria</label><br>
    <label>Outro: <input type="text" name="categoria-outro"></label><br>

   <p>
    <strong>7. Você tem dificuldade de divulgar o seu serviço?</strong>
   </p>
    <label><input type="radio" name="dificuldade-divulgacao" value="sim"> Sim</label><br>
    <label><input type="radio" name="dificuldade-divulgacao" value="as-vezes"> Às vezes</label><br>
    <label><input type="radio" name="dificuldade-divulgacao" value="nao"> Não</label><br>

   <p><strong>8. Com que frequência você tem dificuldade em encontrar clientes?</strong></p>
    <label><input type="radio" name="frequencia-clientes" value="muito-frequente"> Muito frequente</label><br>
    <label><input type="radio" name="frequencia-clientes" value="frequentemente"> Frequentemente</label><br>
    <label><input type="radio" name="frequencia-clientes" value="eventualmente"> Eventualmente</label><br>
    <label><input type="radio" name="frequencia-clientes" value="raramente"> Raramente</label><br>
    <label><input type="radio" name="frequencia-clientes" value="nunca"> Nunca</label><br>

   <p><strong>9. Quais plataformas você utiliza para comunicação e divulgação do seu trabalho?</strong></p>
    <label><input type="checkbox" name="plataformas" value="instagram"> Instagram</label><br>
    <label><input type="checkbox" name="plataformas" value="facebook"> Facebook</label><br>
    <label><input type="checkbox" name="plataformas" value="whatsapp"> WhatsApp</label><br>
    <label>Outro: <input type="text" name="plataformas-outro"></label><br>

   <p><strong>10. Existe algum recurso ou funcionalidade específica que você gostaria de destacar ou solicitar em uma plataforma para trabalhadores autônomos?</strong></p>
    [resposta em texto]
</form>



