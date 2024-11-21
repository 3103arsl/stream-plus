# Stream Plus

A brief description of what this project does and its purpose.

### Prerequisites

- [PHP](https://www.php.net/) (version >= 8.2)
- [Composer](https://getcomposer.org/)
- (Optional) [Symfony CLI](https://symfony.com/download)
- Install Symfony CMD

### Steps to Install

1. Clone the repository:
   ```bash
   git clone https://github.com/3103arsl/stream-plus
   cd stream-plus
   composer install
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   symfony server:start
   http://localhost:8000/
   
### Collections
http://127.0.0.1:8000/api/v1/countries
http://127.0.0.1:8000/api/v1/signup
{
    "name": "Arslan Arif",
    "email": "a260@gm.com",
    "phoneNumber": "0123456789",
    "subscriptionType": 1,
    "addresses": [
        {
            "line1": "123 Main St",
            "line2": "894 Main St",
            "city": "Dubai",
            "state": "Dubai",
            "postalCode": "54000",
            "country": "AE"
        }
    ],
    "paymentMethods": [
        {
            "cardNumber": "1234567812345678",
            "expirationDate": "12/25",
            "cvv": "123"
        }
    ]
}
