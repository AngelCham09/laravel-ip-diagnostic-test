# IP Diagnostic

A simple Laravel-based assessment task to detect and display IP addresses.

## Key Features

* **Client IP Display:** Retrieved the user’s public IP by integrating the ipify API and displaying it on the home page after login.
* **Server IP Retrieval:** Implemented a backend call to ipify to obtain the server’s public IP, with 1-hour caching to reduce external API calls.
* **Performance Optimization:** Applied server-side caching for external API responses.
* **Real-time UI:** Built a responsive home page with loading states and basic error handling.


## Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [YOUR_REPO_LINK]
   cd [YOUR_REPO_FOLDER]

2. **Install dependencies:**
   ```bash
   composer install
   npm install

3. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate

4. **Build Assets & Start Server:**
   ```bash
   npm run dev
   php artisan serve
