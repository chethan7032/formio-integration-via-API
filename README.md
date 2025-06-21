🧩 Laravel + Form.io API Integration
This project demonstrates how to integrate Form.io with Laravel using API endpoints — allowing users to submit forms and admins to view those submissions.

📌 Features
📬 User-facing contact form

🚀 Submit data via Form.io API

💾 Store submissions in Form.io

📥 Fetch and display submissions from Form.io in Laravel

✅ API-based — no SDK, no JavaScript builder



🏗️ Technologies Used
Laravel 11 (PHP 8.3)

Form.io (Free Cloud Project)

Bootstrap (for styling)

Laravel Breeze (for authentication, optional)



⚙️ Setup Instructions

1. 🛠️ Install Laravel Dependencies:
   composer install

2. ✅ Set Permissions
cp .env.example .env
php artisan key:generate


3. 🚀 Start Server
php artisan serve

Open browser: http://127.0.0.1:8000/contact



🔗 Form.io Integration

📤 Submit Form
The Contact Form in /contact will:

POST to Form.io’s Submission Endpoint

Save form data like name, email, message

Optionally, store it in Laravel DB as well


📥 View Submissions

Visit /submissions to fetch and view data via the Form.io GET API

Can filter submissions by:

?email=example@example.com

?date=2025-06-19


📸 Screenshots

![image](https://github.com/user-attachments/assets/54650143-93ed-4656-8189-85e455b3b71e)
These ensures that Api integration is done properly


![image](https://github.com/user-attachments/assets/b687fd08-3b56-4922-b193-3fad05790258)
Simple form 


![image](https://github.com/user-attachments/assets/4a34395d-285f-4d26-8057-8f70e874b928)
List of all submissions with filters














