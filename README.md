# Evaluation laravel

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre système :

- [Composer](https://getcomposer.org/): Pour gérer les dépendances PHP.
- [PHP](https://www.php.net/): Version 7.4 ou supérieure.
- [Node.js](https://nodejs.org/): Pour la gestion des ressources front-end (facultatif).
- [npm](https://www.npmjs.com/): Pour gérer les dépendances JavaScript (facultatif).
- [Base de données](https://laravel.com/docs/8.x/database): Vous pouvez utiliser MySQL, PostgreSQL, SQLite ou d'autres systèmes de gestion de base de données pris en charge par Laravel.

## Installation

1. **Cloner le référentiel**

   Ouvrez un terminal et exécutez la commande suivante pour cloner ce référentiel Git :

   ```bash
   git clone https://github.com/EvannBoistuaud/Evaluation-Laravel.git
    ```
2. **Installer les dépendances PHP**

    Accédez au répertoire de votre projet et exécutez Composer pour installer les dépendances PHP :

    ```bash
    cd votre-projet
    composer install
    ```
3. **Configurer l'environnement**

    Modifiez le ".env" afin d'y mettre vos paramètre pour la base de donnée :

    ```bash
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    ```
4. **Migrer la base de données**

    Créez la structure de la base de données en exécutant les migrations :

    ```bash
    php artisan migrate
    ```
5. **Créer les rôles**

    Créer les rôles intéragissant avec l'application en lançant le seeder :

    ```bash
    composer dump-autoload
    php artisan db:seed --class=RoleSeeder
    ```
    Deux rôles seront crée ; admin et user. Le rôle user sera automatiquement donnée, pour donner le rôle admin à un user suivez les commande suivantes dans Tinker :

    ```bash
    $user=User::find(id_du_user)
    Bouncer::retract('user')->from($user);
    Bouncer::assign('admin')->to($user);
    ```




