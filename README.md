# Serenity

<a name="readme-top"></a>

![Serenity](https://i.imgur.com/mi5e50t.png)


<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#-clone-and-run-serenity">Clone and run Serenity</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#install">Install</a></li>
        <li><a href="#create-the-database">Create the database</a></li>
        <li><a href="#launching">Launching</a></li>
      </ul>
    </li>
    <li>
      <a href="#-architecture-of-serenity">Architecture of Serenity</a>
      <ul>
        <li><a href="#organisation">Organisation</a></li>
        <li><a href="#public-pages">Public pages</a></li>
        <li><a href="#patient-pages">Patient pages</a></li>
        <li><a href="#admin-pages"> Admin pages</a></li>
      </ul>
    </li>
    <li>
      <a href="#-login-to-serenity">Login to Serenity</a>
      <ul>
        <li><a href="#admin">Admin</a></li>
        <li><a href="#patients">Patients</a></li>
      </ul>
    </li>
    <li>
      <a href="#-info-about-serenity">Info about Serenity</a>
        <ul>
          <li><a href="#our-team">Our team</a></li>
          <li><a href="#built-with">Built with</a></li>
        </ul>
    </li>
    <li>
      <a href="#-browser-support">Browser Support</a>
    </li>
    <li>
      <a href="#-license">License</a>
    </li>
  </ol>
</details>



## 🏃 Clone and run Serenity

### Prerequisites

1. Check composer is installed
2. Check yarn & node are installed


### Install

1. Clone this project
2. Run `composer install`
3. Run `yarn install`
4. Run `yarn encore dev` to build assets


### Create the database

1. Create your .env.local
2. Run `php bin/console d:d:c`
3. Run `php bin/console d:m:m`
4. Run `php bin/console d:f:l`
5. Run `sudo apt install php8.1-intl` (for Linux)

### Launching

1. Run `symfony server:start` to launch your local php web server
2. Run `yarn run dev --watch` to launch your local server for assets (or `yarn dev-server` do the same with Hot Module Reload activated)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## 🏠 Architecture of Serenity

### Organisation
There is **2 access levels** to Serenity :

* **Patient :** He can read job offer and apply to any of them
* **Admin :** He can access to any list of items and edit each of them

### Public pages
* Home page at [localhost:8000/](http://localhost:8000/)
* Connect at [localhost:8000/login](http://localhost:8000/login)

### Patient pages
* Dashboard at [localhost:8000/category/](https://localhost:8000/category/)
* Each category can be accessed by clikiong on respective progress bar.

### Admin pages
* Access to the "Alertes du jour" at [localhost:8000/admin](https://localhost:8000/admin)
* Get the list of the "Patients" at [localhost:8000/user/index](https://localhost:8000/user/index)
* Get the list of the "Documents" at [localhost:8000/document/](https://localhost:8000/document/)
* Get the list of the "Checklist" at [localhost:8000/checklist/](https://localhost:8000/checklist/)
* Get the list of the "Professionels de santé" at [localhost:8000/medical/discipline/](https://localhost:8000/medical/discipline/)
* Get the list of the "Préparer l'arrivée" files at [localhost:8000/medical/course/](https://localhost:8000/medical/course/)
* Get the list of the "Schemas" at [localhost:8000/schema/content/](https://localhost:8000/schema/content/)
* Get the list of the "Vidéos" at [localhost:8000/video/](https://localhost:8000/video/)


<p align="right">(<a href="#readme-top">back to top</a>)</p>

## 🔑 Login to serenity

### Admin

* email : `admin@chu-bordeaux.com` // password : `adminCHU1234+`


### Patients

* email : `jeanmichel@gmail.com` // password : `jeanmichel1234+`

* email : `ibrabra@gmail.com` // password : `ibrabra1234+`

* email : `nina@gmail.com` // password : `nina1234+`

* email : `chloe@gmail.com` // password : `cloclo1234+`

* email : `jaky@gmail.com` // password : `jaky1234+`

* email : `martass@gmail.com` // password : `martass1234+`

* email : `fanny@gmail.com` // password : `epiphanie1234+`


<p align="right">(<a href="#readme-top">back to top</a>)</p>


## 📰 Info about Serenity

### Our team

Serenity is a [school](https://www.wildcodeschool.com/) project created by :

* Nina Iacoponelli  [<img src="https://i.imgur.com/A24jKent.jpg">](https://www.linkedin.com/in/nina-iacoponelli/)    [<img src="https://i.imgur.com/WIsDPCxt.jpg">](https://github.com/NinaSwoop)


* Matthieu Dufloux  [<img src="https://i.imgur.com/A24jKent.jpg">](https://www.linkedin.com/in/matthieu-dufloux-036a498a/)    [<img src="https://i.imgur.com/WIsDPCxt.jpg">](https://github.com/MatthDfx)


* Jesse Vallant  [<img src="https://i.imgur.com/A24jKent.jpg">](https://www.linkedin.com/in/jesse-vallant-939ba31a4/)    [<img src="https://i.imgur.com/WIsDPCxt.jpg">](https://github.com/busy-gnl)


* Kévin Albespy [<img src="https://i.imgur.com/A24jKent.jpg">](https://www.linkedin.com/in/kevin-albespy/)    [<img src="https://i.imgur.com/WIsDPCxt.jpg">](https://github.com/kalbespy)


### Built With

* [Symfony](https://github.com/symfony/symfony)
* [Bootstrap](https://getbootstrap.com/)
* [GrumPHP](https://github.com/phpro/grumphp)
* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [PHPStan](https://github.com/phpstan/phpstan)
* [PHPMD](http://phpmd.org)
* [ESLint](https://eslint.org/)
* [Sass-Lint](https://github.com/sasstools/sass-lint)


<p align="right">(<a href="#readme-top">back to top</a>)</p>


## 🌏 Browser Support

| <img src="https://user-images.githubusercontent.com/1215767/34348387-a2e64588-ea4d-11e7-8267-a43365103afe.png" alt="Chrome" width="16px" height="16px" /> Chrome | <img src="https://user-images.githubusercontent.com/1215767/34348590-250b3ca2-ea4f-11e7-9efb-da953359321f.png" alt="IE" width="16px" height="16px" /> Internet Explorer | <img src="https://user-images.githubusercontent.com/1215767/34348380-93e77ae8-ea4d-11e7-8696-9a989ddbbbf5.png" alt="Edge" width="16px" height="16px" /> Edge | <img src="https://user-images.githubusercontent.com/1215767/34348394-a981f892-ea4d-11e7-9156-d128d58386b9.png" alt="Safari" width="16px" height="16px" /> Safari | <img src="https://user-images.githubusercontent.com/1215767/34348383-9e7ed492-ea4d-11e7-910c-03b39d52f496.png" alt="Firefox" width="16px" height="16px" /> Firefox |
| :---------: | :---------: | :---------: | :---------: | :---------: |
| Yes | 11+ | Yes | Yes | Yes |

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## 🎓 License

MIT License

**Copyright (c) 2019 aurelien@wildcodeschool.fr**

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555