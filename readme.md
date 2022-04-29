<div id="top"></div>

# School Administration Information System

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about">About The Project</a>
         <ul>
        <li><a href="#features">Features</a></li>
      </ul>
    </li>
    <li>
      <a href="#installation">Installation</a>
    </li> 
    <li>
      <a href="#credential">Credential</a>
    </li> 
    <li>
      <a href="#screenshoot">Screenshoot</a>
    </li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
  </ol>
</details>

<p id="about">
This system is built with the laravel framework and MySQL database using a template from the LTE admin. which is the result of the development of the previous system, namely the Mail Management System which can be accessed at https://github.com/qkohst/surat_management
</p>

<h4 id="features">
    The features of this system globally include:
</h4>
<ul>
    <li>
       Multi user (Admin, Officer, Student).
    </li>
    <li>
        Manage Master Data (School Identity, Teacher, Student, Study Group, etc).
    </li>
    <li>
        Manage Mail Management (Incoming and Outgoing Mail).
    </li>
    <li>
        Managing Student Payments.
    </li>
    <li>
        Managing Student Savings.
    </li>
    <li>
        Managing School Finances (School Income and Expenditures).
     </li>
    <li>
        Manage and create Financial Reports.
    </li>
</ul>

## Installation 
To run the application on your computer, please follow the following command : 

1. Clone the repo
   ```sh
   $ git clone https://github.com/qkohst/manajemen_administrasi_sekolah.git
   ```
2. Change directory in project which already clone
   ```sh
   $ cd manajemen_administrasi_sekolah
   ```
3. Install Composer packages
   ```sh
   $ composer install
   ```
4. Create database on your computer
5. Create a copy of your .env file 
   ```sh
   $ cp .env.example .env
   ```
6. In the .env file, add database information to allow Laravel to connect to the database
   ```sh
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE={database-name}
   DB_USERNAME={username-database}
   DB_PASSWORD={password-database}
   ```
7. Generate an app encryption key
   ```sh
   $ php artisan key:generate
   ```
8. Seed the database
      ```sh
      $ php artisan db:seed
      ```
9. Running project
    ```sh
    $ php artisan serve
    ```
<p align="right">(<a href="#top">back to top</a>)</p>

<div id="credential"></div>

## Credential in Seeder

Administrator
> Username : admin123@gmail.com
> Password : 123456
> 
<p align="right">(<a href="#top">back to top</a>)</p>

<div id="screenshoot"></div>

## Screenshoot 

![1](https://user-images.githubusercontent.com/57386598/94006552-32757100-fdca-11ea-815c-16fc1691f959.png)
![2](https://user-images.githubusercontent.com/57386598/94006561-36a18e80-fdca-11ea-9e52-8137c047302d.png)
![3](https://user-images.githubusercontent.com/57386598/94006568-3a351580-fdca-11ea-95e4-4ffc5a0dbf3c.png)
![4](https://user-images.githubusercontent.com/57386598/94006579-3d300600-fdca-11ea-8bbe-ca3eedee24eb.png)
![5](https://user-images.githubusercontent.com/57386598/94006592-40c38d00-fdca-11ea-98ed-5648c5a92650.png)
![6](https://user-images.githubusercontent.com/57386598/94006600-44571400-fdca-11ea-8aff-2a99600dc81d.png)

<p align="right">(<a href="#top">back to top</a>)</p>

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
