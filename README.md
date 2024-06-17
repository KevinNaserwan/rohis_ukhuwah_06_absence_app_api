<p align="center"><a href="https://laravel.com" target="\_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p> <p align="center"> <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a> </p>## About This Project

This project is an API for a school attendance application built using Laravel. The API provides functionality for user registration and login, class management, and recording student attendance through QR codes. It includes role-based access control to ensure that only students can generate QR codes and only admins can scan them to record attendance.

## Features

- User Registration and Login
- CRUD Operations for Classes
- Attendance Recording via QR Code
  - QR Code Generation for Students
  - QR Code Scanning and Attendance Recording for Admins
- Role-Based Access Control

## Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- Laravel >= 8.0
- A web server (e.g., Apache, Nginx)
- MySQL or any other supported database

### Installation

1. **Clone the repository:**

   <pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span><div class="flex items-center"</div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">git clone https://github.com/KevinNaserwan/rohis_ukhuwah_06_absence_app_api.git
   cd KevinNaserwan/rohis_ukhuwah_06_absence_app_api
   </code></div></div>

2. **Install dependencies:**

   <pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span><div class="flex items-center"</div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">composer install
   </code></div></div>

3. **Copy the** **`.env.example` file to** **`.env`:**

   <pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span><div class="flex items-center"</div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">cp .env.example .env
   </code></div></div>

4. **Configure your database settings in the** **`.env` file.**
5. **Generate an application key:**

   <pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span><div class="flex items-center"</div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">php artisan key:generate
   </code></div></div>

6. **Run the migrations:**

   <pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span><div class="flex items-center"</div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">php artisan migrate
   </code></div></div>

7. **Serve the application:**

   <pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span><div class="flex items-center"</div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">php artisan serve
   </code></div></div>

## API Endpoints

### Authentication

- **Register:** `POST /api/register`
  - Request:\*\* \*\*`{ "name": "string", "email": "string", "password": "string" }`
  - Response:\*\* \*\*`{ "user": { ... }, "token": "string" }`
- **Login:** `POST /api/login`
  - Request:\*\* \*\*`{ "email": "string", "password": "string" }`
  - Response:\*\* \*\*`{ "user": { ... }, "token": "string" }`

### User Management

- **Get All Users:** `GET /api/users` (Requires authentication)
- **Get User by ID:** `GET /api/user/{id}` (Requires authentication)
- **Delete User:** `DELETE /api/user/{id}` (Requires authentication)

### Class Management

- **Get All Classes:** `GET /api/classes` (Requires authentication)
- **Get Class by ID:** `GET /api/classes/{id}` (Requires authentication)
- **Create Class:** `POST /api/classes` (Requires authentication)
  - Request:\*\* \*\*`{ "name": "string" }`
- **Update Class:** `PUT /api/classes/{id}` (Requires authentication)
  - Request:\*\* \*\*`{ "name": "string" }`
- **Delete Class:** `DELETE /api/classes/{id}` (Requires authentication)

### Attendance Management

- **Get All Absences:** `GET /api/absences` (Requires authentication)
- **Get Absence by ID:** `GET /api/absences/{id}` (Requires authentication)
- **Record Absence via QR Code:** `POST /api/absences/scan-qr` (Admin only)
  - Request:\*\* \*\*`{ "qr_code": "string" }`
- **Generate QR Code:** `POST /api/absences/generate-qr` (Students only)

### Example Usage

1. **Register a User:**

   <pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span><div class="flex items-center"</div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">curl -X POST http://localhost:8000/api/register -d 'name=John Doe&email=john@example.com&password=secret'
   </code></div></div>

2. **Login:**

   <pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span><div class="flex items-center"</div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">curl -X POST http://localhost:8000/api/login -d 'email=john@example.com&password=secret'
   </code></div></div>

3. **Generate QR Code (Student):**

   <pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span><div class="flex items-center"</div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">curl -X POST http://localhost:8000/api/absences/generate-qr -H "Authorization: Bearer {token}"
   </code></div></div>

4. **Scan QR Code (Admin):**

   <pre><div class="dark bg-gray-950 rounded-md border-[0.5px] border-token-border-medium"><div class="flex items-center relative text-token-text-secondary bg-token-main-surface-secondary px-4 py-2 text-xs font-sans justify-between rounded-t-md"><span></span><div class="flex items-center"</div></div><div class="overflow-y-auto p-4" dir="ltr"><code class="!whitespace-pre hljs language-bash">curl -X POST http://localhost:8000/api/absences/scan-qr -H "Authorization: Bearer {token}" -d 'qr_code={base64_encoded_qr_code}'
   </code></div></div>

## License

The Laravel framework is open-sourced software licensed under the\*\* \*\*[MIT license](https://opensource.org/licenses/MIT).

## Contributing

Thank you for considering contributing to this project! Please review and abide by the\*\* \*\*[Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct) to ensure a welcoming community.

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to the project maintainer. All security vulnerabilities will be promptly addressed.

---

This\*\* \*\*`README.md` provides an overview of the project, installation instructions, API endpoints, example usage, and other relevant information. Adjust the GitHub repository URL and any other details as needed.
