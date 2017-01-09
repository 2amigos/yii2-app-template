# Yii 2 Project Template With ConfigKit

This project is an example of what can be done with 
[https://github.com/sidekit/config](https://github.com/sidekit/config).

It's a proposed application project template for Yii2 projects. This new template is perfect for projects of any size. 
Even though the Yii community recommends the usage of the advanced project template, but if we look carefully at that 
template you'll soon realize that what it has is simply three applications in one: `backend / frontend / console`. So, 
what's the difference between that template and this one? A shared common folder and another app? What stops you from doing the 
same with this type of starting point architecture? Right, absolutely nothing.

Our knowledge and experience with Yii has taught us that the advanced template is not really necessary to build anything that this 
template cannot also handle. Do you wish to create a super-admin application? Then simply add another folder wherever 
you wish and inject the shared resources from the `src` folder, the `business` or `domain` logic. 

If you are using our proposed template then please take into consideration some recommendations from us:

- Make sure your application logic **is not within** your models. Yes, avoid that MVC pattern recommendation to have 
thick models. You will surely end up with many God objects (monolithic models with huge amounts of code that become so hard to 
maintain that you'll regret the day you started coding them; especially, when you have to port that business logic to a 
better/newer architecture).
- Keep your controllers thin, your models thinner and your views as clean of PHP and JS code as you can. 
- If your application is going to be large, please, do not use the events of your models even though they allow you to 
do so, make sure they are not being part of a large process. You will end up with a nightmare hard to test, hard to 
maintain and/or scale. Try to implement the observer pattern differently, allowing your pool of observer objects to be 
notified about those events. That will make your code easier to test.
- Do not mix different code in your views. Please, please, do not use inline scripts and/or css do not inject javascript 
code in your PHP files, do not use the dynamic javascript jquery onload capabilities of the framework. I believe this approach is so wrong. Use it for small projects, but do not use it for large ones. Stick with separation of concerns, and
keep js where it should be: at the frontend, within JS files... and do us all a favor, do not be a fashionist. Don't end 
up having your HTML templates in your javascript components, even if the library allows you to do so. K.I.S.S., my friends, K.I.S.S.
all the way.
- Use task managers, or module bundlers for your javascript files. We have added a `.bowerrc` and `gulpfile.js` to keep 
it as simple as possible. Yii Asset Bundlers are good and serve the purpose for small projects, but be honest, is this where
the Web design trends are going nowadays?
  
Yii is a great framework, because of all the tools that it encapsulates. It has great flexibility and even though a lot 
of people complain about its inheritance madness and internal design, it is still a good robust framework. We just need to be 
very cautious with that power, as it could bring you more problems than advantages. 


## Directory Structure
```
app                 [ Yii's application related code: commands, components, controllers, bundles, models, modules, 
|                     views and widgets ]
├── assets          [ contains asset's definitions ]
├── commands        [ contains Console commands (Yii names them controllers) ]
├── controllers     [ contains Web controller classes ]
├── models          [ contains model calsses ]
└── views           [ contains view files for the Web application ]
bin                 [ contains command-line executable scripts ]
bootstrap           [ contains bootstrap process files ]
config              [ contains application configuration files ]
public              [ contains Web application entry script + static resources ]
runtime             [ contains files generated during application's runtime ]
src                 [ contains business logic files. Portable code, free of Yii's code. Build your library here. ]
tests               [ contains codeception tests for your application ]
```

## Requirements 

The minimum requirement by this project template that your Web server supports PHP 5.4.0. But we highly recommend you 
use the latest PHP 7+. 


## Installation 

### Install via Composer 

If you do not have Composer, you may install it by following the instructions at getcomposer.org.

You can then install this project template using the following command:

```
php composer.phar global require "fxp/composer-asset-plugin:^1.2.0"
php composer.phar create-project --prefer-dist --stability=dev sidekit/yii2-app-basic your-site-name
```

Once the commands finish simply do the following: 

```
cd your-site-name 
composer start-server 
```

You will then can access your application on `http://localhost:8080`. To stop the server, simply type on your terminal  
`composer stop-server` and it will be stopped. You could also simply `Ctrl+C` to stop the script execution. 

Please note, that the composer's commands included on this template have been tested on Linux | Mac environments, no 
Windows sorry. 


## Testing

Tests are located in tests directory. They are developed with Codeception PHP Testing Framework. By default there are 3 
test suites:

- unit
- functional
- acceptance

First run the test server. This command will `inject` the `index-test.php` script on your 
web root so you will be able to run your functional and acceptance tests: 

```
composer start-test-server 
```

Then tests can be executeb by running:
 
``` 
composer exec codecept run
```

Or, if you have codeception installed globally simply: 

```
codecept run 
```

## Clean code
 
We have added some development tools for you to check your work for clean code: 

- PHP mess detector: Takes a given PHP source code base and look for several potential problems within that source.
- PHP code sniffer: Tokenizes PHP, JavaScript and CSS files and detects violations of a defined set of coding standards.
- PHP code fixer: Analyzes some PHP source code and tries to fix coding standards issues. Please, modify `.php_cs` to 
  suit your needs. 

And you should use them in that order. 

### Using php mess detector

Sample with all options available:

```bash 
 ./vendor/bin/phpmd ./src text codesize,unusedcode,naming,design,controversial,cleancode
```

### Using code sniffer
 
```bash 
 ./vendor/bin/phpcs -s --report=source --standard=PSR2 ./
```

### Using code fixer

We have added a PHP code fixer to standardize our code. It includes Symfony, PSR2 and some contributors rules. 

```bash 
./vendor/bin/php-cs-fixer fix ./src --config .php_cs
```

[![2amigOS!](https://s.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0?s=80)](http://www.2amigos.us) 
