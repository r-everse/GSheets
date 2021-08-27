# Deprecation notice

This package is deprecated and will soon be removed. We suggest using [google/apiclient](https://packagist.org/packages/google/apiclient) directly.

## reverse/g-sheets

[![Build Status](https://travis-ci.org/r-everse/GSheets.svg?branch=master)](https://travis-ci.org/r-everse/GSheets)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/r-everse/GSheets/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/r-everse/GSheets/?branch=master)


PHP client for Google Sheets. \
This library provides a set of class and methods to work with Google Api Client for PHP [google/apiclient](https://github.com/googleapis/google-api-php-client).

### Requirements
 - php >= 5.6

### Installation

```bash
composer require reverse/g-sheets:"dev-master"
```

### Using GSheets
To work with Google Sheets have to init `Client` and `Spreadsheets` classes.

```php
$googleClient = new \Google_Client($config);
$client = new Client($googleClient);
spreadsheets = new Spreadsheets($client, 'sheetid'); 
```

### Operations

#### Append
```php
$value = new Value('a', 'b', 'c');
$spreadsheets->append($value, 'Sheet1');
```

#### Update
```php
$value = new Value('a', 'b', 'c');
$spreadsheets->update($value, 'Sheet1');
```

#### Clear
```php
$spreadsheets->clear('Sheet1!1:2');
```

#### Get
```php
// This get return Sheet1's first column
$spreadsheets->get('Sheet1!1:1');
```

#### Delete
```php
// This call delete first row of sheets specified
// sheetId is gid not sheet's name
$delete->execute(Delete::DIMENSION_ROWS, '12675hakas', 0, 1);
```
