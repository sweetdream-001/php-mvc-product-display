# PHP MVC Product Display Application

A clean, maintainable PHP MVC application that loads and displays product data from JSON, with filtering capabilities via GET parameters.

## Project Overview

This application demonstrates best practices in PHP development following the Model-View-Controller architectural pattern. It loads product data from a JSON file and displays it in a responsive HTML table with filtering options.

## Features

- MVC architecture with clear separation of concerns
- Object-oriented approach with properly encapsulated components
- JSON data loading and parsing
- Dynamic filtering via GET parameters
- Responsive table display with product details
- Configuration using .env file
- Default image handling for missing product images
- Comprehensive test suite

## Requirements

- PHP 7.4 or higher
- Composer
- GD extension (for generating default images)
- Web server (Apache/Nginx) with URL rewriting
- Xdebug (for test coverage reporting)

## Installation

1. Clone the repository
```
git clone https://github.com/sweetdream-001/php-mvc-product-display.git
cd php-mvc-product-display
```
2. Install dependencies
```
composer install
```
3. Configure environment
```
cp .env.example .env
```
4. Start development server
```
composer run-script serve
```

5. Access the application at `http://localhost:8000`

## Usage

### Viewing Products

Navigate to the base URL of your application to see all products displayed in a table format.

### Filtering Products

Use the filter form at the top of the page to filter products by:
- Product Name
- Product Code

## Testing
This project includes a comprehensive test suite with unit, integration, and functional tests using PHPUnit.

### Test Structure

    tests/
    ├── Unit/                   # Tests for individual components

    │       ├── Models/         # Model tests

    │       ├── Services/       # Service layer tests
 
    │       └── Repositories/   # Data access tests

    ├── Integration/            # Tests for component interactions

    └── Functional/             # End-to-end application tests

### Running Tests
Run all tests:
```
./vendor/bin/phpunit
```
### Run a specific test suite:
```
./vendor/bin/phpunit --testsuite unit
```
### Run a specific test file:
```
./vendor/bin/phpunit tests/Unit/Models/ProductTest.php
```
### Code Coverage
To generate a code coverage report, ensure Xdebug is installed and properly configured, then run:
```
./vendor/bin/phpunit --coverage-html coverage
```
Open coverage/index.html in your browser to view the detailed coverage report.

### Adding New Tests
1. Create a new test class in the appropriate directory

2. Extend PHPUnit\Framework\TestCase

3. Add test methods with names starting with test

4. Run PHPUnit to execute your new tests

### Test Requirements
- PHPUnit 9.x

- Xdebug for code coverage (optional)

- Test configuration is defined in phpunit.xml

Development
Coding Standards
This project follows PSR-12 coding standards. To check compliance:
```
composer run-script check-style
```

## Adding New Features
### Adding New Filter Criteria

- Update the ProductRepository::getFilterOptions() method to include new filter options

- Add the new filter field to the form in app/Views/products/_filter_form.php

- Ensure your Product model has a corresponding getter method

### Adding New Product Fields
Update the Product model in app/Models/Product.php to include new properties and getters

- Update the view in app/Views/products/index.php to display the new fields

- Update the JSON data structure if necessary

### Security Considerations
- All output in views is properly escaped with htmlspecialchars()

- Input validation is performed before processing

- File paths are validated to prevent directory traversal

### Performance Optimization
- JSON data is loaded only when needed

- Filtering is performed in-memory for rapid response

- Static assets are minimized and cached


### Contributing
- Fork the repository

- Create your feature branch (git checkout -b feature/amazing-feature)

- Commit your changes (git commit -m 'Add some amazing feature')

- Push to the branch (git push origin feature/amazing-feature)

- Open a Pull Request

- Ensure all tests pass before requesting review