# Sumit Mahi 
# Pràctica 05 - Social Authentication & Miscel·lània

## Controllers:
- **admin.php**: Aquest codi s'encarrega de gestionar les funcionalitats administratives (admin panel). Assegura que només els usuaris amb privilegis administratius puguin accedir al tauler d'administració.
- **AuthController.php**: Aquest codi serveix per gestionar l'autenticació dels usuaris, inclosos els processos d'inici de sessió i registre. Interacciona amb el model `Usuari` per realitzar operacions de base de dades relacionades amb l'autenticació d'usuaris. El fitxer inclou mètodes per gestionar l'inici de sessió d'usuari validant les credencials i establint variables de sessió, i el registre d'usuari validant l'entrada, comprovant els noms d'usuari existents i creant un nou usuari si la validació passa.
- **changepswd.php**: Aquest codi gestiona la funcionalitat de canvi de contrasenya per als usuaris.
- **delete_user.php**: Aquest codi només és per als usuaris administradors per eliminar la resta d'usuaris.
- **delete.php**: Aquest codi és per eliminar articles (rellotges).
- **edit.php**: Aquest codi és per editar articles (rellotges).
- **index.php**: Aquest codi inicialitza els controladors necessaris, obté les dades de rellotge paginades i inclou la vista principal per representar la pàgina. Gestiona la gestió de sessions, estableix una galeta de mida de lletra i gestiona la paginació per mostrar els rellotges.
- **insert.php**: Aquest codi és per inserir un article nou (rellotge).
- **login.php**: Aquest codi gestiona l'inici de sessió de l'usuari i el token recorda'm.
- **logout.php**: Aquest codi gestiona el procés de tancament de sessió de l'usuari cridant al mètode `logout` de la classe `AuthController`. Assegura que s'acaba la sessió de l'usuari i s'esborren les galetes "recorda'm".
- **my_watch.php**: Aquest codi garanteix que només els usuaris autenticats puguin accedir a la pàgina, recupera els rellotges creats per l'usuari que ha iniciat sessió.
- **profile.php**: Aquest codi garanteix que només els usuaris autenticats puguin accedir a la pàgina d'actualització del perfil, processar l'enviament del formulari per actualitzar els detalls del perfil, gestionar les càrregues de fitxers d'imatges de perfil i desar la informació actualitzada a la base de dades.
- **recover_password.php**: Aquest codi gestiona el procés de recuperació de la contrasenya generant un token de restabliment, desant-lo a la base de dades i enviant un correu electrònic amb el token de restabliment a l'usuari si existeix el correu electrònic proporcionat (PHPMailer).
- **reset_password.php**: Aquest codi gestiona el procés de restabliment de la contrasenya validant el token de restabliment, comprovant la força de les noves contrasenyes i actualitzant la contrasenya de l'usuari a la base de dades de totes les validacions.
- **search.php**: Aquest codi recupera els rellotges que coincideixen amb la consulta de cerca, els combina amb els que no coincideixen i genera HTML per mostrar els resultats de la cerca, inclosos els detalls del rellotge i les accions per editar o suprimir si l'usuari té els permisos adequats.
- **signup.php**: Aquest codi gestiona el registre d'usuaris validant l'entrada, comprovant els noms d'usuari i correus electrònics existents i inserint un usuari nou a la base de dades si passen totes les validacions.
- **tancar.php**: Aquest codi tanca la sessió de l'usuari destruint la sessió i eliminant la galeta de sessió, assegurant-se que l'usuari està completament tancat.
- **watch_details.php**: Aquest codi recupera informació detallada sobre un rellotge específic de la base de dades mitjançant l'identificador de rellotge proporcionat i inclou la vista per mostrar aquests detalls.
- **WatchController.php**: Aquest codi defineix la classe `WatchController`, que gestiona les operacions relacionades amb els rellotges, com ara la inserció, la recuperació, l'actualització i la supressió de rellotges i registres a la base de dades.

## Models:
- **User.php**: Aquest codi defineix la classe "Usuari", que gestiona les operacions relacionades amb l'usuari, com ara el registre, l'inici de sessió, la comprovació de noms d'usuari i correus electrònics existents i la recuperació de les dades de l'usuari per ID.
- **Watch.php**: Aquest codi gestiona diverses operacions relacionades amb els rellotges, com ara la recuperació, la inserció, l'actualització i la supressió de registres de rellotges a la base de dades.

## src:
- **Exeption.php**
- **OAuth.php**
- **PHPMailer.php**
- **POP3.php**
- **SMTP.php**
### **/images**
- **imatge.jpg**

## Views:
- **admin.view.php**
- **changepswd.view.php**
- **delete.view.php**
- **edit.view.php**
- **index.view.php**
- **insert.view.php**
- **login.view.php**
- **my_watch.view.php**
- **profile.view.php**
- **recover_password.view.php**
- **reset_password.view.php**
- **search_results.view.php**
- **signup.view.php**
- **watch_details.view.php**

### Estils:
- **admin.css**: Estils per a la pàgina de admin (admin panel).
- **changepaswd.css**: Estils per a la pàgina de canvi de contrasenya.
- **delete.css**: Estils per a la pàgina d'eliminació de rellotge.
- **edit.css**: Estils per a la pàgina d'edició del rellotge.
- **index.css**: Estils per a la pàgina main.
- **insert.css**: Estils per a la pàgina d'inserció del rellotge.
- **login.css**: Estils per a la pàgina d'inici de sessió.
- **profile.css**: Estils per a la pàgina de perfil.
- **recover_password.css**: Estils per a la pàgina de recuperació de la contrasenya.
- **reset_password.css**: Estils per a la pàgina de restabliment de contrasenya.
- **signup.css**: Estils per a la pàgina de registre.
- **styles.css**: Estils per la pàgina main.

#### config.php:
**Defineix els paràmetres de connexió de la base de dades i estableix una connexió a la base de dades MySQL.**

#### Readme.md:
**El fitxer Readme.md.**
