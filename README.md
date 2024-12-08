# Git e Github
Tags: #informatica #programacao #ControleDeVersao 
#git #github

--- 


## O que é Git? 
- O Git é um [[Sistema de Controle de versões]] distribuido de [[código aberto]], desenvolvido em 2005 por [[Linus Torvalds]], criador do [[kernel]] do [[linux]].

- No git é onde você usará os comandos para iniciar seu repositorio local, e depois enviá-lo ao github.
---
## O que é GitHub

- GitHub é um serviço baseado em nuvem que hospeda o sistema de controle de versão (VCS) chamado Git. Ele permite que os desenvolvedores colaborem e façam mudanças em projetos compartilhados enquanto mantêm um registro detalhado do seu progresso.
- O github armazena diversos repositorios remotos, aonde programadores podem contribuir em projetos próprios ou de outras pessoas.

---
# Introdução
## Iniciando e utilizando um repositório local
---

- Inicie o Git na pasta que você deseja versionar, 
![[GitAsset_Gitbashhere.png  | 500x300]]
- então o terminal abrira na pasta solicitada
![[GitAsset_Gitpath.png | 500x300 ]]
---
### Git init

- O git init vai inicializar um repositório local, na pasta em que o git se encontra no momento.
Perceba que na pasta que você deseja versionar, apos o git init, haverá um pasta oculta chamada .git

![[GitAsset_Gitinit.png | 600x400 ]]

- Nessa pasta temos diversas configurações do nosso repositório local, e com a criação dela, confirmarmos que nosso repositório foi criado com sucesso.
---
### Git Add 
- Agora que ja temos nosso repositório local preparado, vamos usar o git add, para colocar os arquivos selecionados em uma  [[Staging area]], nessa  area é como se você estivesse convocando e gerenciado os arquivos que você vai querer subir no repositório.

- Aqui eu crie o arquivo index, e quero dar commit nele para o nosso repositorio local, vamos ver como fica o processo: 

![[GitAsset_Gitadd.png | 500x300]]

---
### Git status

![[GitAsset_Gitadd.png]]

- O Git Status mostra pra gente os caminhos que têm diferenças entre o arquivo do índice e o commit atual, como a criação e modificação de arquivos que ainda não foram "commitados".

- Perceba que o git status mostra na imagem acima que o arquivo index.txt foi criado, e esta na Stanging area para o próximo commit.
---
### Git commit
![[GitAsset_Gitadd.png]]
- Commits são como fotos da última versão do nosso código. Eles carregam tudo o que foi alterado em nosso projeto para que, quando precisarmos, possamos voltar ao commit onde possuíamos a versão que gostaríamos de utilizar.
![[Pasted image 20220124115806.png]]
- Essa foto é enviada para nosso repositório local, que ja pode ser utilizado, porém para enviarmos para o nosso repostório remoto no Github, precisamos continuar esse processo.

-  ```git commit -m "Coloque sua mensagem aqui"```
sempre que for fazer um commit use o ```-m``` para digitar a mensagem de descrição do commit.
---
## Iniciando e utilizando um repositório remoto
---

### Criando um repositório remoto no github
- é so entrar no https://github.com/  
![[Pasted image 20220124125318.png | 300x400 ]]
- e clicar em "new" na barra lateral esquerda
![[Pasted image 20220124125400.png | 450x450]]
- E aqui é so preencher as informações e continuar,

- Pronto seu repositorio remoto foi criado!!
---
### Linkando os repositórios

#### git remote
-  usamos o `git remote add origin <link do repositório>`, neste comando estamos adicionando o repositório remoto e vinculando seu link a palavra origin, para assim conseguimos encaminhar o commit para o repositório correto.  

-   `origin` é o nome utilizado por padrão para referenciar o nosso repositório.
---

### Enviando e recebendo informações do repositório remoto
#### git push 
-    o `commit` que damos na máquina não sobe automaticamente para a plataforma, para isso precisaremos empurrar, enviar para lá com o `git push -u origin main`.

- Utilize o  `-u` apenas na primeiro push, ele serve para causar o comando `git branch --set-upstream`, que associa o branch main local, com o branch main/origin remoto, chamado de upstream.

- `git push 'remote_name' 'branch_name'`, empurrando o branch selecionada para o repositório remoto.
---
#### git pull
- o git pull puxa os dados do repositorio remoto do github, para p seu repositório local.

---
