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

### Controllers

- **BookController.php**: Handles all book-related operations such as creating, updating, deleting, and fetching books.
- **UserController.php**: Manages user-related operations including login, signup, and password changes.

### Models

- **Book.php**: Represents the Book model and contains methods for interacting with the book data in the database.
- **User.php**: Represents the User model and contains methods for interacting with the user data in the database.

### Public

- **Estils/**: Contains CSS files for styling the application.
  - **styles.css**: General styles for the application.
  - **edit.css**: Styles specific to the edit book page.
  - **login.css**: Styles specific to the login page.
  - **change-psw.css**: Styles specific to the change password page.
- **functions.php**: Contains utility functions used throughout the application.
- **login.php**: Handles user login functionality.
- **logout.php**: Handles user logout functionality.
- **signup.php**: Handles user signup functionality.
- **delete.php**: Handles book deletion functionality.
- **edit.php**: Handles book editing functionality.
- **insert.php**: Handles book insertion functionality.
- **update.php**: Handles book update functionality.
- **index.php**: The main entry point of the application, displays the list of books.
- **session_check.php**: Checks if the user session is active.
- **change-psw.php**: Handles password change functionality.
- **flash.php**: Manages flash messages for user feedback.

### Views

- **index.view.php**: The main view displaying the list of books.
- **edit.view.php**: The view for editing a book.
- **insert.view.php**: The view for inserting a new book.
- **delete.view.php**: The view for deleting a book.
- **login.view.php**: The view for user login.
- **signup.view.php**: The view for user signup.
- **change-psw.view.php**: The view for changing the user password.

### config.php

Contains configuration settings for the application, such as database connection details.
