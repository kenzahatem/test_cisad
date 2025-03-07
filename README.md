
# test_technique - Stack technique PHP - Symfony

## Versions

- PHP : PHP 8.4.4 (cli)
- Composer : Composer version 2.8.6
- Symfony : Symfony CLI version 5.11.0
- PostgreSQL : 16




## Routes du Projet

### 1. **Page d'accueil et d'authentification**

- **Route**: `/login`
- **Méthodes**: `GET` et `POST`

Page de connexion pour les utilisateurs.

**Fonctionnalités** :
- Connexion avec un nom d'utilisateur (username).

---

### 2. **Page d'enregistrement d'un utilisateur**

- **Route**: `/register`
- **Méthodes**: `GET` et `POST`

Formulaire pour enregistrer un nouvel utilisateur.

**Fonctionnalités** :
- Permet de créer un nouvel utilisateur avec un nom d'utilisateur, un email, un mot de passe et un rôle.

---

### 3. **CRUD Utilisateur (ROLE_ADMIN)**

- **Route**: `/user`


### 4. **Gestion des profils des utilisateurs**

- **Route**: `/user/profil`
- **Méthodes**: `GET`

Permet à l'utilisateur connecté de consulter son propre profil. Accessible pour les utilisateurs ayant le rôle `ROLE_USER`.

**Fonctionnalités** :
- Affichage du profil de l'utilisateur connecté, incluant son nom d'utilisateur et ses informations liées (victoire défaite).

---

### 5. **Table `infos` et CRUD**

- **Route**: `/infos`

### 6. **Importation d'un fichier CSV (ROLE_ADMIN)**

- **Route**: `/import_csv`
- **Méthodes**: `POST`

Permet à un administrateur d'importer un fichier CSV pour ajouter plusieurs utilisateurs en une seule fois.

**Fonctionnalités** :
- Importer un fichier CSV qui contient des informations utilisateur.
- Renvoie un message de succès ou un message d'erreur 

### 7. **Déconnexion**

- **Route**: `/logout`

Focntionnalité ajouté avec symfony.