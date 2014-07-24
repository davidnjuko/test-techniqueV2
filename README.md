test-techniqueV2
================

1. Créer une interface permettant de saisir un nouvel utilisateur (Prénom, Nom, email, password, date de naissance, date de création, date de modification)
2. Créer une interface que liste les utilisateurs
3. Ajouter les interfaces de modification d'un utilisateur
4. Ajouter la supression d'un utilisateur
5. Intégrer elasticsearch à l'application de sorte à indexer les utilisateurs dans Elastic search (ES)
6. Surcharger les sélection d'utilisteur pour utiliser ES au lieu de la base de données

Respecter le PSR-2 (vérification avec codesniffer)
Ecrire les test unitaire sur **au moins les entités** de l'application
Intégrer elasticsearch une fois l'application développée à l'aide du **gestionnaire d'évènement** de ZF2

Elasticsearch doit être accessible en local sur le port 9200.

Informations
============

Les dépendances du projet sont gérées avec composer. Sont déjà inclues les dépendances suivant :
Doctrine Module (https://github.com/doctrine/DoctrineModule)
Elastica (https://github.com/ruflin/Elastica)
PHPUnit (http://phpunit.de/)

Pour les tests unitaires, les fichiers de configuration sont prets pour des fichiers dans le dossier : ./module/Application/tests/ApplicationTest

Ce test vous permet de montrer vos **connaissances et compétences avec zend framework 2 & Doctrine (+ elasticsearch)** dans le but d'intégrer une équipe qui développe avec les même technologie.


Commandes utiles
================

Mettre à jour le schéma de la base de données par rapport aux entités définies dans le projet :
./vendor/bin/doctrine-module orm:schema-tool:update --force
Mettre à jour les proxies doctrine
./vendor/bin/doctrine-modul orm:generate-proxies

Installer les dépendances avec composer :
composer install --dev

Mettre à jour les dépendances avec composer :
composer update
