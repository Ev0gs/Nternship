# Nternship.fr

This site was designed as part of the end-of-year WEB project at CESI Bordeaux.

The development team is composed of :
- WAUTERS Mathis
- LATORSE Pierre
- LAGNEAUX Arthur
- RAAD Camille

The website has been developed in order to allow CESI students to facilitate their research and application for internship online. The site is accessible to all persons having a code provided by a tutor or an administrator.

## How to download it ?

The Project is saved on [Github] servers (https://github.com/CESI-StageAdvisor/Projet_Web). The code is open source and can be downloaded from the repository or cloned with (gh repo clone CESI-StageAdvisor/Projet_Web).
A specify database is used on the website to store all the data. 
We have used a MySQL database named projet_web with  10 tables (address, candidacy, company, graduates, internship_offer, located, manage, promotion, users, wishlist).

Contact us to get more informations about this database.

## Features

You have to be logged in, to access the site.

On the student side, the site allows you to :
- Search for an internship
- Apply for an internship offer
- Consult the internships for which you have applied
- Add an internship to a Wishlist and consult it
- Consult and rate companies
- Search for companies

On the tutor's side, the site allows you to
- Consult internship offers
- Modify or delete an internship offer
- Consult, modify or add a user
- Consult, modify or add a company
- Consult users that applied an internshipOffer

An administrator has access to all the site's features.

## Used technologies

The site is developed using the [Bootstrap] framework (https://getbootstrap.com/docs/4.0/getting-started/introduction/).

It uses a model view controller (MVC) architecture:
- 9 Controllers
- 7 Models
- 26 Views (3-Candidacy, 5-Company, 3-Components, 5-InternshipOffer, 1-Legalmentions, 1-Main, 5-Users, 2-Wishlist, 1-Offline)

Apache server is used to host the site with xampp.
The data is stored locally in a MySQL database.
The site is hosted on a virtual host.
The domain name of the site is [nternship.fr](http://nternship.fr).
The access to the site is secured by a secure authentication.

The site is also accessible in a safe mobile version thanks to an android emulator and the [PWA] technology (https://developers.google.com/web/progressive-web-apps/).

## MVC Architecture
### Introduction

There are three parts on the architecture
- The Model
- The View
- The Controller

### Routings

The root of the site is the [index.php] file. It is the entry point of the site. 

How our routing is done :
First, the controller will take the controller matching with the URL.
Then, the controller will make business operation using the model's function.
Finally, the controller will generate the view to display the data.
It will use this type of url : (http://nternship.fr/CONTROLLER/FUNCTION/PARAMETERS)

### Model

This Model part manages the data of the site. The role of the Model is to get information from the database, organize it and assemble it to permits the controller to manage te edata. This includes SQL queries.
It is composed of the following classes :
- Address
- Candidacy
- Company
- InternshipOffer
- Legalmentions
- Main
- Users
- Wishlist

### View

The View is the part of the architecture that deals with the presentation. It is the part that is responsible for the presentation of the data. It is also responsible for the dynamic rendering of the data.
It is composed of the following files :
- Candidacy
- Company
- InternshipOffer
- Legalmentions
- Main
- Users
- Wishlist
- Offline

### Controller

The controller is the last element of the MVC structure and it is also the main element. It will take care of receiving the data entered by the user and communicating the changes to the models. It will also be able to communicate with the models to obtain information that it can then transfer to the view.
It is composed of the following classes :
- Candidacy
- Company
- InternshipOffer
- Legalmentions
- Main
- Users
- Wishlist
- Offline

## Security

The website is secured HTTPS with a ssl certificate. And some features are available offline.
A Secured authentification is necessary to access the site.
All passwords are encrypted using the [bcrypt algorithm](https://www.php.net/manual/fr/function.password-hash.php).
All the data is stored in a MySQL database.

## Used Logo

- [Bootstrap](https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-social.png)
- [Font Awesome](https://fontawesome.com/icons?d=gallery)

## Useful Links

- [CESI](https://www.cesi.fr/)
- [CESI Bordeaux](https://www.cesi.fr/bordeaux/)
- [Bootstrap](https://getbootstrap.com/)
- [Font Awesome](https://fontawesome.com/)

## Contacts

- Mathis Wauters : mathis.wauters@viacesi.fr
- Pierre Latorse : pierre.latorse@viacesi.fr
- Arthur LAGNEAUX : arthur.lagneaux@viacesi.fr
- Camille RAAD : camille.raad@viacesi.fr

## Licence

This sites use a licence [CC BY-NC-ND 4.0](https://creativecommons.org/licenses/by-nc-nd/4.0/).

## Legal Mentions

The legal notices have been written in accordance with the rules of French law.

- nternship.fr
- Hosting company: Virtual Hosting

Site made for education use with no commercial purpose.
The site is exempt from declaration to the National Commission for Information Technology and Civil Liberties (CNIL) insofar as it does not insofar as it does not collect any data concerning the users. Any use, reproduction, distribution, marketing, modification of all or part of the Site, without the authorization of the Editor is prohibited and may result in legal action and prosecution such as notably envisaged by the Code of the intellectual property and the Civil code.
