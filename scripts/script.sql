DROP DATABASE IF EXISTS youdemy_db;

CREATE DATABASE youdemy_db;
USE youdemy_db;

-- TODO: table roles
CREATE TABLE
    roles (
        role_id int primary key auto_increment not null,
        role_name varchar(20) not null
    );

-- TODO: table users
CREATE TABLE
    users (
        user_id int primary key not null auto_increment,
        firstname varchar(20) not null,
        lastname varchar(20) not null,
        phone varchar(15) not null,
        email varchar(100) not null unique,
        password varchar(255) not null,
        isActive boolean default 1,
        -- HACK: enseignant fields
        sexe enum ("male", "female") default null,
        age int default null,
        address text default null,
        cin varchar(10) default null,
        specialite varchar(50) default null,
        niveau_academique varchar(100) default null,
        avatar varchar(255) default null,
        -- HACK: field 'isRequested' will be used to track the requests of users who want to be enseignant
        isRequested int default null,
        -- FIX: foreign keys here
        -- HACK: roles: admin:1 enseignant:2 etudiant:3
        role_id int default 3,
        foreign key (role_id) references roles (role_id) on delete set null
    );

-- TODO: table categories
CREATE TABLE
    categories (
        category_id int primary key auto_increment not null,
        category_name varchar(25) not null,
        image varchar(255) not null
    );

-- TODO: table tags
CREATE TABLE
    tags (
        tag_id int not null auto_increment primary key,
        tag_name varchar(25) not null
    );

-- TODO: table courses
CREATE TABLE
    courses (
        cours_id int primary key not null auto_increment,
        title varchar(100) not null,
        subtitle varchar(100) not null,
        description text not null,
        image varchar(255) not null,
        created_at timestamp default current_timestamp,
        updated_at timestamp null default null,
        langues enum ("english", "frnech", "arabe") not null,
        type enum ("video", "document") not null,
        -- FIX: Foreign keys here
        category_id int,
        foreign key (category_id) references categories (category_id) on delete set null
    );

-- TODO: Associative table (many to many between courses and tags)
CREATE table
    courses_tags (
        cours_id int,
        tag_id int,
        primary key (cours_id, tag_id),
        foreign key (cours_id) references courses (cours_id) on delete cascade,
        foreign key (tag_id) references tags (tag_id) on delete cascade
    );

-- TODO: table requests
CREATE TABLE
    requests (
        request_id int primary key auto_increment not null,
        created_at timestamp default current_timestamp,
        -- FIX: foreign keys here
        user_id int,
        foreign key (user_id) references users (user_id) on delete cascade,
    );

-- TODO: table enrollements
CREATE TABLE
    enrollements (
        enroll_id int primary key auto_increment not null,
        created_at timestamp default current_timestamp,
        -- FIX: foreign keys here
        user_id int,
        foreign key (user_id) references users (user_id) on delete set null,
        cours_id int,
        foreign key (cours_id) references courses (cours_id) on delete set null
    );