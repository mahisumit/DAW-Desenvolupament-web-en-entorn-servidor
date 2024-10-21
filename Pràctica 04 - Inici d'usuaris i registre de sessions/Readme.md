# Sumit Mahi 👨‍💻

# Pràctica 04 - Inici d'usuaris i registre de sessions

## Estructura del Projecte

El projecte està organitzat en les següents carpetes i fitxers:

prova4.1/
├── Controllers/
│   ├── BookController.php
│   ├── UserController.php
├── models/
│   ├── Book.php
│   ├── User.php
├── Public/
│   ├── Estils/
│   │   ├── styles.css
│   │   ├── edit.css
│   │   ├── login.css
│   │   ├── change-psw.css
│   ├── functions.php
│   ├── login.php
│   ├── logout.php
│   ├── signup.php
│   ├── delete.php
│   ├── edit.php
│   ├── insert.php
│   ├── update.php
│   ├── index.php
│   ├── session_check.php
│   ├── change-psw.php
│   ├── flash.php
├── Views/
│   ├── index.view.php
│   ├── edit.view.php
│   ├── insert.view.php
│   ├── delete.view.php
│   ├── login.view.php
│   ├── signup.view.php
│   ├── change-psw.view.php
├── config.php

### Controladors

- **BookController.php**: Gestiona totes les operacions relacionades amb els llibres, com ara crear, actualitzar, eliminar i obtenir llibres.
- **UserController.php**: Administra les operacions relacionades amb els usuaris, incloent inici de sessió, registre i canvis de contrasenya.

### Models

- **Book.php**: Representa el model de Llibre i conté mètodes per interactuar amb les dades dels llibres a la base de dades.
- **User.php**: Representa el model d'Usuari i conté mètodes per interactuar amb les dades dels usuaris a la base de dades.

### Públic

- **Estils/**: Conté els fitxers CSS per a l'estil de l'aplicació.
  - **styles.css**: Estils generals per a l'aplicació.
  - **edit.css**: Estils específics per a la pàgina d'edició de llibres.
  - **login.css**: Estils específics per a la pàgina d'inici de sessió.
  - **change-psw.css**: Estils específics per a la pàgina de canvi de contrasenya.
- **functions.php**: Conté funcions utilitàries usades a tota l'aplicació.
- **login.php**: Gestiona la funcionalitat d'inici de sessió d'usuaris.
- **logout.php**: Gestiona la funcionalitat de tancament de sessió d'usuaris.
- **signup.php**: Gestiona la funcionalitat de registre d'usuaris.
- **delete.php**: Gestiona la funcionalitat d'eliminació de llibres.
- **edit.php**: Gestiona la funcionalitat d'edició de llibres.
- **insert.php**: Gestiona la funcionalitat d'inserció de llibres.
- **update.php**: Gestiona la funcionalitat d'actualització de llibres.
- **index.php**: El punt d'entrada principal de l'aplicació, mostra la llista de llibres.
- **session_check.php**: Comprova si la sessió de l'usuari està activa.
- **change-psw.php**: Gestiona la funcionalitat de canvi de contrasenya.
- **flash.php**: Gestiona els missatges flash per a la retroalimentació de l'usuari.

### Vistes

- **index.view.php**: La vista principal que mostra la llista de llibres.
- **edit.view.php**: La vista per a editar un llibre.
- **insert.view.php**: La vista per a inserir un nou llibre.
- **delete.view.php**: La vista per a eliminar un llibre.
- **login.view.php**: La vista per a l'inici de sessió d'usuaris.
- **signup.view.php**: La vista per al registre d'usuaris.
- **change-psw.view.php**: La vista per al canvi de contrasenya de l'usuari.

### config.php

Conté la configuració de l'aplicació, com ara els detalls de connexió a la base de dades.
