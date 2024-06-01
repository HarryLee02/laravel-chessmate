<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## About ChessMate

ChessMate is a web application built using [Laravel framework](https://laravel.com/docs/11.x/) and [Firebase](https://firebase.google.com/) Realtime Database.
## Working features
- Play with computer
- QR code for shop items
- Sign in
- Sign out
## Contributing
- **Team members:**
    - Lê Ngọc Hiếu
    - Nguyễn Việt Hoàng 
    - Ngô Hồng Phúc
    - Võ Nguyễn Thái Học
    - Trần Minh Hiếu
- **Supervisors:**
    - Trần Tuấn Dũng
## Requirement
- [Firebase account](https://firebase.google.com/)
- [Laravel framework 11](https://laravel.com/docs/11.x/)
- [PHP 8.x](https://www.php.net/downloads.php) (tested on 8.3.3)
- [Composer](https://getcomposer.org/download/)
- [Laravel installer](https://github.com/laravel/installer) (optional)
### Additional packages
- [laravel-firebase](https://github.com/kreait/laravel-firebase#configuration)
## Installation
```bash
git clone https://github.com/HarryLee02/laravel-chessmate.git
cd laravel-chessmate
composer update
```
Download the **Firebase Admin SDK private key** file.
Paste the file in the root of the project
```bash
\laravel-chessmate\privatekey.json
```
Then manually change the `.env` file with your key 
```
FIREBASE_PROJECT= <name>
FIREBASE_CREDENTIALS= <private.json>
FIREBASE_DATABASE_URL= <your_db_url>
```
Then run `php artisan serve` and access http://127.0.0.1:8080

## Google Page Speed
![image](https://i.ibb.co/n8sLj6h/gg-pagespeed.png)

## Underdevelop features
- Playing online (Realtime with Laravel is **hard**)
- Admin page
- Post blogs (can post but not showing yet)
## Side notes
All of the frontend is stored in [this](https://github.com/HarryLee02/ChessMate_Frontend).
