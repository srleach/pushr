# pushr
Modular PHP Push Notification Helper

## Usage

#### Installation

Simply require the module using composer, as normal:

````bash
composer require srleach\pushr
````

You're ready to get started.

#### Using pushr

Pushr was designed to fill a gap in a project. That gap was the need for a system to allow push notifications to be
sent in a flexible manner. Using a library such as this abstracts that decision to one that can be changed with little
fuss at a later date, allowing you to make a just-in-time decision over which provider you'll use without blocking development.

To create a push notification, you need to get an instance of a 'push notification'

````php
<?php

public function helloWorld()
{
    // Get a push notification.

}
````
## About.

Note that this library was developed initially for use with the Parse.com push notification service.
This service is extremely flexible, and allows a fair number of devices on their free tier. That said,
There are also many other Push providers which may eventually be added to this module, time permitting.

These __may__ include:

- Amazon SNS
- Firebase

And any others I receive suggestions to create an adapter for.

