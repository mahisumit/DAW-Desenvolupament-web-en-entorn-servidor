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

### Descripció dels Fitxers Principals

#### controllers/BookController.php

Aquest fitxer conté la lògica del controlador per gestionar les operacions relacionades amb els llibres, com ara obtenir llibres per pàgina, obtenir el nombre total de llibres, crear, editar i eliminar llibres.

#### models/Book.php

Aquest fitxer conté la lògica del model per interactuar amb la base de dades. Inclou mètodes per obtenir llibres, obtenir el nombre total de llibres, crear, editar i eliminar llibres.

#### public/Estils/styles.css

Aquest fitxer conté els estils generals per a l'aplicació, incloent-hi l'animació de fons, estils per a la barra de navegació, botons i la paginació.

#### public/Estils/edit.css

Aquest fitxer conté els estils específics per al formulari d'edició de llibres, incloent-hi l'alineació dels camps i l'estil del botó de guardar.

#### public/functions.php

Aquest fitxer conté funcions auxiliars que s'utilitzen a l'aplicació, com ara la funció per mostrar missatges flash.

#### public/login.php

Aquest fitxer conté la lògica per gestionar l'inici de sessió dels usuaris.

#### public/logout.php

Aquest fitxer conté la lògica per gestionar el tancament de sessió dels usuaris.

#### public/signup.php

Aquest fitxer conté la lògica per gestionar el registre de nous usuaris.

#### public/delete.php

Aquest fitxer conté la lògica per eliminar llibres de la base de dades.

#### views/index.view.php

Aquest fitxer conté la vista principal que mostra la llista de llibres amb opcions per editar i eliminar llibres, així com la paginació.

#### views/edit.view.php

Aquest fitxer conté la vista per editar un llibre existent. Inclou un formulari amb camps per al títol, descripció, autor ID i any de publicació.

#### views/insert.view.php

Aquest fitxer conté la vista per inserir un nou llibre. Inclou un formulari amb camps per al títol, descripció, autor ID i any de publicació.
