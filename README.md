# 🏆👨‍🏫 Champion Courses

Champion courses is a simple app developed as a job interview challenge.

## Challenge

*YOU MUST DEVELOP A SYSTEM TO MANAGE A COURSE PLATFORM. YOU MUST MANAGE DATA OF STUDENTS, TEACHERS, SUBJECTS AND PAYMENTS*

### Basic Entities:
- STUDENTS
- TEACHERS
- SUBJECTS
- PAYMENTS
- ADMIN

**You must determine the access roles for each entity, design the database and the tables of each entity with the fields that you think are appropriate and necessary.**

### Description
#### Admins Role
You should be able to add students, teachers, subjects, and payments. The STUDENT entity must have the basic information and be able to register the monthly payments of fees per subject, this data can be taken inside or outside the entity as they consider, be able to keep track of the subjects they are studying, they can only take 5 subjects at time, show how much you have to pay per month and take the grade of each subject for each subject.
The TEACHERS entity must have the basic information of the teacher, take inside or outside the entity how much it has to charge for the subjects it teaches, its fee is 80% of the value of the fee paid by the student, it cannot teach more than 5 subjects per week.
The SUBJECTS entity must have at least one description and monthly cost of it
The administrator must be able to relate the students with the subjects they are going to take and the professors with the subjects they teach, this can be seen by teachers to see which subjects they teach and students to know which ones they should take.

#### Teacher Role
You must be able to edit the student's profile and in each subject that he has taken, he can place the corresponding notes, as well as knowing how many students he has per class.
Being able to see according to the number of subjects taught and students how much should be charged per month.
You must be able to take or delete subjects assigned to you

#### Student Role
You should be able to see the subjects you must take, only add but not remove subjects from your profile, see how much you must pay monthly depending on which ones you take.

### Applied Solution

Version 8 of PHP was used with the Laravel 8 framework with MySQL database and Bootstrap UI styles and components.

#### Basic ERD used
The user entity manages the roles of administrator, teacher and student.

![ERD](https://raw.githubusercontent.com/marcocajeao/champion-courses/master/public/MER_championCourses.png) 

## Installation
For the installation it's required to have *MySQL* and *Composer* installed on your system or some application that contains them such as *XAMPP*, *WAMP*, *Devilbox*, etc. Then you must follow the following steps:

- Access the directory where the project will be saved and clone the repository:

``` sh
    git clone https://github.com/marcocajeao/champion-courses.git
```
- Install dependencies with Composer:

``` sh
    composer install
```

- Copy the .env.example file as .env to edit it.

``` sh
    cp .env.example .env
```

- Create the database with the following name:

``` sql
    CREATE DATABASE champion_courses;
```

- Edit the `DB_DATABASE` variable of the `.env` file:

``` sh
    DB_DATABASE=champion_courses
```

- Run migrations and seeders for the database with the following command:

``` php
    php artisan migrate --seed
```

- Generate laravel key with command:

``` php
    php artisan key:generate
```

- Seeders create student, teacher and administrator users. The latter can be accessed with the following credentials:

**user:** admin@championcourses.loc
**password:** 1234

***NOTE***: *For all other test users the password is the same as the administrator.*
