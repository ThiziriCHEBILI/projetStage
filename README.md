# NOVA

NOVA est une plateforme de streaming de films, de séries et de dessins animés.
Le catalogue est visible sans connexion.
Avec un compte, on peut regarder les vidéos, garder ses titres dans « Ma Liste » et reprendre une vidéo là où on s'est arrêté.

Dans ce prototype, les vidéos sont des bandes-annonces YouTube, pour respecter les droits d'auteur.

## Les technologies

**Front-end** (dossier `frontend`)

- React
- TypeScript
- Vite
- Sass

**Back-end** (dossier `backend`)

- PHP
- Symfony
- Doctrine
- MySQL

Le back-end est une API qui renvoie seulement du JSON.
Le front-end affiche les pages et appelle l'API.

## Les prérequis

Installez ces outils avant de commencer :

| Outil       | Version utilisée dans le projet |
| ----------- | ------------------------------- |
| PHP         | 8.5                             |
| Composer    | 2.10                            |
| Symfony CLI | 5.20                            |
| Node.js     | 24                              |
| npm         | 11                              |
| MySQL       | 8.0                             |

## L'installation du back-end

Toutes les commandes se lancent dans le dossier `backend`.

```bash
cd backend
```

### 1. Installer les bibliothèques

```bash
composer install
```

### 2. Créer le fichier `.env.local`

Créez un fichier `.env.local` dans le dossier `backend`.
Mettez-y l'adresse de votre base MySQL :

```dotenv
DATABASE_URL="mysql://utilisateur:mot_de_passe@127.0.0.1:3306/nom_de_la_base?serverVersion=8.0&charset=utf8mb4"
APP_SECRET=une_longue_valeur_aleatoire
JWT_PASSPHRASE=votre_phrase_secrete
```

Remplacez toutes ces valeurs par les vôtres.
JWT_PASSPHRASE doit être choisie avant l'étape 3, car elle protège les clés JWT.

### 3. Générer les clés JWT

Les clés JWT servent à signer le token de connexion.

```bash
php bin/console lexik:jwt:generate-keypair
```

Les clés sont créées dans le dossier `config/jwt`.

### 4. Créer la base de données

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

La première commande crée la base.
La deuxième crée les tables.

### 5. Charger les données de test

```bash
php bin/console doctrine:fixtures:load
```

**Attention : cette commande vide toute la base avant d'ajouter les données de test.**
Elle ajoute les catégories, les shows et leurs vidéos.
Elle ne crée pas de compte : créez le vôtre avec la page d'inscription du site.

### 6. Lancer le serveur de l'API

```bash
symfony server:start
```

L'API répond sur http://localhost:8000.

Si le terminal affiche une adresse en `https`, lancez plutôt :

```bash
symfony server:start --no-tls
```

Le front-end appelle l'API à l'adresse `http://localhost:8000`.

## L'installation du front-end

Ouvrez un deuxième terminal, dans le dossier `frontend`.

```bash
cd frontend
```

### 1. Installer les bibliothèques

```bash
npm install
```

### 2. Lancer le site

```bash
npm run dev
```

Ouvrez http://localhost:5173 dans votre navigateur.

L'API doit être lancée en même temps (voir plus haut).

## La sécurité

Le fichier `.env.local` et les clés JWT du dossier `config/jwt` ne doivent jamais être envoyés sur GitHub.
Ils contiennent des secrets.
Ils sont déjà ignorés par le fichier `.gitignore` du back-end.

## L'organisation des dossiers

```text
my_project/
├── backend/          L'API Symfony
│   ├── config/       La configuration (sécurité, CORS, JWT…)
│   ├── migrations/   Les migrations de la base de données
│   ├── public/       Le point d'entrée de l'API et les images
│   └── src/          Le code : contrôleurs, entités, formulaires, repositories…
└── frontend/         Le site React
    ├── index.html    La seule page HTML
    └── src/          Le code : pages, composants, hooks, styles, types…
```
