# Changelog

All notable changes to `LemonSqueeze.php` will be documented in this file.

## 1.2.0 - 2023-04-03

### Added
- [FEATURE] Support the LemonsSqueeze Store API.
- New Store method `getAllStores`.
- New Store method `getStore`.
- [FEATURE] Support the LemonsSqueeze Customer API.
- New Store method `getAllCustomers`.
- New Store method `getStoreCustomers`.
- New Store method `getCustomer`.

### Fixed
- Refactoring the User Entity.
- Adding the Id into the returned entity.

### Removed
- User's `getId` method.

## 1.0.1 - 2023-03-29

- Fixing GitHub actions.

## 1.0.0 - 2023-03-29

- Initial release.
- Including HttpClient.
- Adding the User endpoint methods from the Lemon Squeeze official API.

