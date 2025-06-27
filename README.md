# Acme Widget Co Basket

## Overview

A proof-of-concept basket for Acme Widget Co, with delivery and offer rules, written in PHP with clean architecture and full test coverage.

## Features

- Product catalogue, delivery charge, and offer rules are all pluggable (Strategy Pattern)
- Fully unit tested (PHPUnit)
- Static analysis (PHPStan)
- Dockerized for easy setup

## How to Run

```sh
docker-compose run --rm app composer install
docker-compose run --rm app vendor/bin/phpunit
docker-compose run --rm app vendor/bin/phpstan analyse
```

## Assumptions

- Product codes are unique.
- Only one offer is active at a time.
- Delivery charge is based on the post-offer subtotal.

## Example Baskets

| Products                | Total  |
|-------------------------|--------|
| B01, G01                | 37.85  |
| R01, R01                | 54.37  |
| R01, G01                | 60.85  |
| B01, B01, R01, R01, R01 | 98.27  |