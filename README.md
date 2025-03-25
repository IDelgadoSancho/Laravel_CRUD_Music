# Laravel CRUD Music

This is a Laravel-based web application for managing music artists. It provides CRUD (Create, Read, Update, Delete) functionality for managing artist records, including their name, musical genre, country of origin, and profile picture.

## Features

- List all artists.
- Search artists by musical genre.
- Add new artists with profile pictures.
- Edit artist details and update profile pictures.
- Delete artists.

## Project Structure

The project follows the standard Laravel directory structure. Key directories and files include:

- `app/Http/Controllers/ArtistaController.php`: Contains the logic for managing artists.
- `app/Models/Artista.php`: Defines the `Artista` model.
- `resources/views/artista/`: Contains the Blade templates for artist-related views.
- `routes/web.php`: Defines the routes for the application.
- `public/`: Stores publicly accessible files, including uploaded artist images.

## Installation

1. Clone the repository:
    ```bash
    git clone <repository-url>
    cd Laravel_CRUD_Music
    ```

2. Install dependencies:
    ```bash
    composer install
    npm install
    ```

3. Set up the environment:
   - Copy .env.example to .env
    ```bash
    cp .env.example .env
    ```
    
   - Update the .env file with your database and other configuration details.
    Generate the application key:
    ```bash
    php artisan key:generate
    ```

4. Run database migrations:
    ```bash
    bash php artisan migrate

5. Serve the application:
   ```bash
   php artisan serve
   ```

6. Compile frontend assets:
    ```
    npm run dev
    ```

## Usage

Access the application in your browser at http://localhost:8000.
Use the navigation to list, search, add, edit, or delete artists.
Environment Variables
The following environment variables are used in the project:

RUTA_IMATGES: Path for storing artist images.

## Routes

The application defines the following routes:

- /artista/list: Displays a list of all artists.
- /artista/new: Form to create a new artist.
- /artista/edit/{id}: Form to edit an existing artist.
- /artista/delete/{id}: Deletes an artist.
- /artista/cerca: Searches for artists by genre.


1. Testing
Run the test suite using PHPUnit:
    ```bash
    php artisan test    
    ```

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request.

## License

This project is open-source and available under the MIT License.

