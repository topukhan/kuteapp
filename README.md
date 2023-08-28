# Notification Implementation in Laravel App

This is a basic guide to the notification implementation in a Laravel app. This app allows users to create posts, like posts, comment on posts, and manage friend requests. The primary focus of this README is on implementing notifications.

## Features

-   User Authentication
-   Create Posts
-   Like and Comment on Posts
-   Send and Accept Friend Requests
-   Notifications for Post Likes and Comments, Friend Requests, and Accepted Requests

## Getting Started

### Prerequisites

-   PHP (7.4 or higher)
-   Laravel Framework
-   Composer

### Installation

1. Clone this repository: `git clone https://github.com/topukhan/broadcasting.git`
2. Install composer dependencies: `composer install`
3. Copy `.env.example` to `.env` and configure your database settings.
4. Generate an application key: `php artisan key:generate`
5. Migrate the database: `php artisan migrate`
6. <!-- Optional: --> Run the database seeder to populate sample users: `php artisan db:seed --class=UsersTableSeeder`
7. Start the development server: `php artisan serve`

## Notification Implementation

### Post Like and Comment Notifications

-   When a user likes or comments on a post, a notification is sent to the post owner.
-   Notifications are sent using Laravel's built-in `Notification` class.
-   Notification messages are defined in the `App\Notifications` directory.
-   Notifications can be sent using the `notify` method on the `User` model.

### Friend Request Notifications

-   When a user sends a friend request, a notification is sent to the requested user.
-   When a user accepts a friend request, a notification is sent to the sender of request.

## Usage

1. Register and log in to the app.
2. Create posts and interact with them (like, comment).
3. Send and accept friend requests.
4. Check the notifications button to see new notifications.
5. Click on notifications to view and manage them.

## Credits

This app is developed based on Laravel and uses the following technologies:

-   Laravel Framework
-   Blade Templates
-   Tailwind CSS
-   Alpine.js
-   MySQL (for development)

## License

This project is licensed under the [MIT License](LICENSE).
