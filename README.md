# Example Api

PHP library for Example API interaction, includes Auth authorization and API methods.

## 1. Prerequisites

* PHP 8.2

## 2. Installation

The Example Api can be installed using Composer by running the following command:

```sh
composer require danil/api
```

## 3. Initialization

Create ApiClient object using the following code:

```php
$api = new \Danil\Api\Client\ApiClient();
```

## 4. Authorization

The library provides the authorization by secret api token.

### 4.1. Authorization Code Flow

Auth Authorization Code Flow allows calling methods from the server side.

Create `Auth` object first:

```php
$auth = new \Danil\Api\Auth\Auth();
```

#### 4.1.1. For getting **user access key** use following command:

```php
$auth = new \Danil\Api\Auth\Auth();
$accessToken = $auth->getAccessToken('example_api_key');
```

## 5. API Requests

### 5.1. Request sample

Example of calling method **comments.get**:

```php
$apiClient = new ApiClient();
$comments = $apiClient->comments()->get($accessToken, [
    'page'  => 1,
]);
