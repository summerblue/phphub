# Contributing Guide

This page contains guidelines for contributing to the `PHPHub` project. Please review these guidelines before submitting any pull requests to the project.

This contributing guide is based on the [Laravel Contribution Guide](https://github.com/laravel/framework/blob/master/CONTRIBUTING.md).

## Pull Requests

The pull request process differs for new features and bugs. 

### Features
Before sending a pull request for a new feature, you should first create an issue with [Proposal] in the title. 

The proposal should describe the new feature, as well as implementation ideas. 

The proposal will then be reviewed and either approved or denied. 

Once a proposal is approved, a pull request may be created implementing the new feature.

### Bugs

Pull requests for bugs may be sent without creating any proposal issue. 

If you believe that you know of a solution for a bug that has been filed on GitHub, please leave a comment detailing your proposed fix.

## Feature Requests

If you have an idea for a new feature you would like to see added to Laravel, you may create an issue on GitHub with [Request] in the title. The feature request will then be reviewed by [@summerblue](https://github.com/summerblue).

## Coding Standards

The `PHPHub` project follows the [PSR-0](http://www.php-fig.org/psr/psr-0/), [PSR-1](http://www.php-fig.org/psr/psr-1/) and [PSR-2](http://www.php-fig.org/psr/psr-2/) coding standards. 

Although the current codebase isn't compliant yet, pull requests are required to adhere to these coding standards.

### Docblocks

The use of docblocks is required. New code which isn't documented with docblocks for functions will be refused.

When writing `@param` or `@return` statements it's encouraged to use the full namespace instead of the reference. This is to improve the readability to know immediatly which type of object you're dealing with.

## Testing

The current test suite is still being worked on,  but we encourage you to write tests for new code and/or features.
