# Laravel Contacts CRUD Application  

This is a simple Laravel application for managing contacts with CRUD operations. It also includes functionality to bulk import contacts using an XML file and export a sample XML file for reference.  

## Technologies Used  
- Laravel 10  
- MySQL  
- Laravel Breeze for authentication  
- Repository Pattern for better code structure 

## Features  
- Add, edit, delete, and view contacts.  
- Bulk import contacts from an XML file.  
- Export a sample XML file for reference.  
- Implemented Repository and Interface pattern for clean code.  
- Validation for errors and success messages in imports.  

## Installation Steps  

### 1. Clone the Repository  
```bash
git clone <your-github-repo-url>
cd <your-project-folder>
```

### 2. Install Dependencies
```
composer install
npm install
```

### 3 .Set Up the Environment
```
cp .env.example .env
```

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
### 4 .Run these command
```
php artisan key:generate
```


```
php artisan migrate

npm run dev

php artisan serve
```
