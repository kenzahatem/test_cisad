# Aide pour le test technique #

## Installation du projet  ##
- [ ] https://symfony.com/download Pour installer le framework
- [ ] https://getcomposer.org/ Installer composer (pour les packages)
- [ ] symfony new --webapp test_technique
- [ ] composer install dans le dossier du projet cela va installer les packages du framework (dans le dossier vendor)
- [ ] Lancer le serveur ``` symfony server:start``` dans le dossier du projet
- [ ] Modifier le .env par exemple pour postgres
```  DATABASE_URL="postgresql://nom_utilisateur:mot_de_passe@127.0.0.1:5432/nom_bdd?serverVersion=13&charset=utf8" ```
- [ ] Ouvrir un nouveau terminal pour creer la base de donnee et executer ```php bin/console doctrine:database:create```

### A cette etape normalement le projet tourne sur localhost:8000 et la base de donnees est cree

Bien lire la documentation
- [ ] https://symfony.com/doc/current/security.html#the-user cela va creer un utilisateur dans le dossier Entity/User.php
- [ ] https://symfony.com/doc/7.3/security.html#security-make-registration-form pour ajouter un utilisateur
- [ ] ``` php bin/console make:crud``` cela va creer un crud avec l'utilisateur, mais il y aura une erreur quand vous irez sur la page a cause d'un champ de User
- [ ] ``` php bin/console make:entity infos ```
- [ ] https://packagist.org/packages/league/csv ``` composer require league/csv``` pour la partie csv
- [ ] https://symfony.com/doc/current/controller/upload_file.html et https://symfony.com/doc/current/forms.html#creating-form-classes

