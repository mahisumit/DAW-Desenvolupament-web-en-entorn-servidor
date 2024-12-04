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
### **/images:**
- **imatge.jpg**

## Views:
- **admin.view.php**: El codi és responsable de representar la interfície del tauler d'administració. Mostra una llista d'usuaris i ofereix opcions per eliminar usuaris.
- **changepswd.view.php**: Aquest codi representa la interfície d'usuari per canviar la contrasenya. Inclou camps de formulari perquè l'usuari introdueixi el seu correu electrònic, la contrasenya actual, la nova contrasenya i la confirmi.
- **delete.view.php**: Aquest codi representa la interfície d'usuari per confirmar l'eliminació d'un rellotge. Mostra a missatge de confirmació i ofereix opcions a qualsevol de les dues confirmeu l'eliminació o cancel·leu l'acció.
- **edit.view.php**: Aquest codi representa la interfície d'usuari per editar els detalls d'un rellotge específic. Inclou camps de formulari preemplenats amb els detalls actuals del rellotge i permet a l'usuari actualitzar la informació.
- **index.view.php**: 
- **insert.view.php**: Aquest codi representa la interfície d'usuari per inserir un rellotge nou. Inclou camps de formulari per a l'usuari per introduir els detalls del rellotge i carregar una imatge, i mostra qualsevol missatge d'èxit o error.
- **login.view.php**: Aquest codi representa la interfície d'usuari per a la pàgina d'inici de sessió. Inclou camps de formulari per a l'usuari per introduir el seu correu electrònic o nom d'usuari, contrasenya i una opció per recordar l'inici de sessió.
- **my_watch.view.php**: Aquest codi representa l'usuari interfície per mostrar els rellotges creats pel usuari connectat. Inclou una llista de rellotges amb opcions per editar o suprimir cada rellotge.
- **profile.view.php**: Aquest codi representa la interfície d'usuari per actualitzar el perfil de l'usuari. Inclou camps de formulari per
l'usuari per actualitzar el seu nom d'usuari i avatar, i això mostra els missatges d'èxit.
- **recover_password.view.php**: Aquest codi representa el interfície d'usuari per a la pàgina de recuperació de contrasenya. Inclou un formulari perquè l'usuari introdueixi la seva adreça de correu electrònic sol·licitar un restabliment de la contrasenya i mostra qualsevol error o
missatges d'èxit.
- **reset_password.view.php**: Aquest codi representa l'usuari interfície per a la pàgina de restabliment de la contrasenya. Inclou forma
camps perquè l'usuari introdueixi una nova contrasenya i confirmi i mostra qualsevol missatge d'error o èxit.
- **search_results.view.php**: Aquest codi representa l'usuari interfície per mostrar els resultats de la cerca. Mostra una llista de rellotges que coincideixen amb la consulta de cerca o un missatge si no es troben resultats.
- **signup.view.php**: Aquest codi representa la interfície d'usuari per a la pàgina de registre. Inclou camps de formulari per a l'usuari introduïu el seu nom d'usuari, correu electrònic, contrasenya i confirmeu contrasenya. També mostra els missatges d'error o d'èxit.
- **watch_details.view.php**: Aquest codi representa l'usuari interfície per mostrar informació detallada sobre a rellotge específic. Inclou el nom del rellotge, el preu, informació, imatge i enllaç a la pàgina oficial.

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
