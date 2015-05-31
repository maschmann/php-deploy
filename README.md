# php-deploy

PHP wrapper for ansible deployments.
This repo intends to mainly provide a nice and easy way to manage ansible deployments to different servers and by different methods.
Ansible has become my favorite provisioning tool for most of my projects, so wrapping up the commandline stuff and maybe creating a GUI for showing the deloyment results is the next logixal step.
The user authentication relies on FOSUserBundle, to keep things plain and simple. 

## What does it do?

Mainly there's a symfony2 application and ansible. Symfony provides the commandline tools and the gui, ansible does the hard work :-)

## Installation

Clone, checkout or composer install the repo.

### initialize database

```
$ app/console doctrine:database:create
```

```
$ app/console doctrine:schema:update --force
```
### get your ansible deployments into place

Your deployments go here:
```
php-deploy
  |
  |- app
  |
  |- deployment
  |    |
  |    |- <your deployment here>
  |    |    |- roles
  |    |    |- playbook.yml
  |    |    |- inventory
  |
  |- src
  |- web
```

### some things you need to consider

 * if your deployment is key-based, your php (or webserver) user needs to have it in its ssh folder
 * all actions will be done with the webserver user until we've implemented cronjob-based deployments
  
