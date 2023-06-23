# Free Ads (Laravel)



Free Ads est un site d'annonces réalisé avec le Framework Laravel. Il permet aux utilisateurs de publier et consulter des annonces dans différentes catégories.

## Fonctionnalités

- Inscription et connexion des utilisateurs.
- Publication, modification et suppression d'annonces.
- Recherche d'annonces avec filtres.
- Messagerie entre utilisateurs.
- Gestion du profil utilisateur.

## Prérequis

- PHP 7.4 ou version supérieure
- Composer
- Serveur Web (Apache, Nginx, etc.)
- MySQL ou un autre système de gestion de base de données pris en charge par Laravel

## Installation

1. Clonez ce dépôt de code sur votre machine locale :
   ```
   git clone ce-projet
   ```

2. Accédez au répertoire du projet :
   ```
   cd free-ads
   ```

3. Installez les dépendances du projet à l'aide de Composer :
   ```
   composer install
   ```

4. Créez un fichier d'environnement `.env` en vous basant sur le fichier `.env.example` fourni. Mettez à jour les informations de connexion à votre base de données.

5. Générez une clé d'application unique :
   ```
   php artisan key:generate
   ```

6. Exécutez les migrations pour créer les tables de base de données :
   ```
   php artisan migrate
   ```

7. Démarrez le serveur de développement Laravel :
   ```
   php artisan serve
   ```

8. Accédez à l'application dans votre navigateur à l'adresse `http://localhost:8000`.

## Contribution

Les contributions sont les bienvenues ! Pour contribuer à Free Ads, suivez ces étapes :

1. Effectuez un fork du projet.
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`).
3. Committez vos modifications (`git commit -m 'Add some AmazingFeature'`).
4. Poussez la branche (`git push origin feature/AmazingFeature`).
5. Ouvrez une pull request.

---

**Note :** Ce projet est réalisé dans le cadre du cours sur les Frameworks MVC avec Laravel. Il peut être soumis à des améliorations et des optimisations.
