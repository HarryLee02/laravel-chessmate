<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## About ChessMate

ChessMate is a web application built using [Laravel framework](https://laravel.com/docs/11.x/) and [Firebase](https://firebase.google.com/) Realtime Database.\
Live example [here](https://chessmate.games/).\
Apache Webserver setup tutorial: https://youtu.be/gjzptnxvX6Q?si=OmutSIZUG0guNkZ7
## Working features
- Play with computer
- Practice
- QR code for shop items
- Sign in
- Sign out
## Contributing
- **Team members:**
    - Lê Ngọc Hiếu        -    22520435
    - Nguyễn Việt Hoàng   -    22520471
    - Ngô Hồng Phúc       -    22521124
    - Võ Nguyễn Thái Học  -    22520489
    - Trần Minh Hiếu      -    22520445
- **Lecturer:**
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
```
git clone https://github.com/HarryLee02/laravel-chessmate.git
cd laravel-chessmate
composer update
```
Download the **Firebase Admin SDK private key** file.
Paste the file in the root of the project
```
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
- Puzzle
- Admin page
- Post blogs (can post but not showing yet)
- More computers (Stockfish, Komodo, .etc)
## Side notes
All of the frontend is stored in [this](https://github.com/HarryLee02/ChessMate_Frontend).

## Questions from Lecturer (Vietnamese)
1. Nginx sẽ được dùng cấu hình như thế nào? ( What's the configuration of Nginx (?) )

> 

2. Web server khác với web service ở điểm nào? ( What's the difference between Web server and Web service? )

>

3. Giải thích rõ hơn về Web Server. ( Explain more about Web Server)

>

4. Các webServer khác nhau có những điểm mạnh khác nhau, vậy từng loại webServer sẽ phù hợp với những trường hợp nào? ( Each Web Server has its own strength, then which one is suitable in which case? )

>

5. Trong LAMP, WAMP, … dùng cái nào thì tối ưu nhất? ( In LAMP, WAMP, ... which (Web Server) is the most optimal?

>

6. Trong một môi trường có nhiều ứng dụng web chạy song song, bạn sẽ sử dụng apache hay engine x (Nginx) cho cân bằng tải? Tại sao? ( In an environment which has multiple Web application running at the same time, will you choose Apache or Nginx for load balancing? Why? )

>

7. Tại sao không dùng nginx với php mà lại dùng apache với php mặc dù nginx hiệu suất cao hơn? ( Why not use Nginx with PHP even though Nginx has better efficiency than Apache ?)

>
