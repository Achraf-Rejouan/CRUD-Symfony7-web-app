# Symfony 7 Project Setup

This guide will help you set up and run this Symfony 7 project on your local machine.

---

## 🧰 Requirements

Make sure you have the following installed:

- PHP >= 8.2
- [Composer](https://getcomposer.org/)
- [Symfony CLI (optional but recommended)](https://symfony.com/download)
- MySQL or PostgreSQL (or another DB, depending on your project)
- Node.js and npm (if frontend assets are used)

---

## 🚀 Installation Steps

### 1. Clone the repository

```bash
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Set up environment variables

Create a local environment file:

```bash
cp .env .env.local
```

Edit `.env.local` and configure your database and other local settings:

```dotenv
DATABASE_URL="mysql://username:password@127.0.0.1:3306/dbname?serverVersion=8.0"
```

### 4. Set up the database

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. (Optional) Compile frontend assets

If the project uses Symfony Asset Mapper or Webpack Encore:

```bash
# For Asset Mapper
php bin/console asset-map:compile

# OR for Webpack Encore
npm install
npm run dev
```

### 6. Run the Symfony server

Using Symfony CLI:

```bash
symfony server:start
```

Or using PHP's built-in server:

```bash
php -S localhost:8000 -t public
```

### 7. (Optional) Generate Symfony secrets keys

If needed (e.g., missing decryption keys):

```bash
php bin/console secrets:generate-keys
```

### 8. Check system requirements

```bash
composer symfony:requirements
```

---

## 🥪 Running Tests

If the project includes tests, run them with:

```bash
php bin/phpunit
```

---

## 📁 Ignored Files

This project’s `.gitignore` excludes:

- Local environment files (`.env.local`, etc.)
- Cache and logs (`/var/`)
- Vendor and build files (`/vendor/`, `/public/assets/`)
- Symfony secrets for production
- PHPUnit config and cache


