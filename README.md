# Shop with Saif

Shop with Saif is a PHP/MySQL e-commerce application. It provides a public storefront, customer accounts, product browsing, a session-based shopping cart, order tracking, profile management, and an administrator area for managing the shop catalog, sponsors, categories, and orders.

This repository is a custom PHP application built on top of Bootstrap-based shop and dashboard templates. It uses a lightweight MVC-like organization rather than a full PHP framework.

## Project Status

The project is a functional academic/personal e-commerce application, but it is not production-ready. The repository does not include a database dump, migration system, Composer configuration, automated tests, payment integration, or shipping integration. Some older template pages and legacy action scripts remain in the repository beside the active routed application.

## Main Features

### Public visitors

- View the public home page.
- Open the login page.
- Create a customer account.
- Request a password reset using the registered email, security question, and security answer.
- Set a new password after passing the password-reset verification step.

### Authenticated customers

- Browse active product categories.
- Browse products by category.
- View product details, including price, promotion, description, available sizes, colors, and image.
- Add a product variant to the cart with size, color, and quantity.
- View pending cart items and totals.
- Confirm the cart as an order.
- Cancel an individual pending order.
- View order history.
- View the details of an order belonging to the logged-in account.
- View and edit profile information.
- Upload a profile photo where supported.
- Log out and destroy the current session.

### Administrators

Administrators can access the dashboard and:

- Create, view, update, archive, and restore categories.
- Create, view, update, archive, and restore products.
- Upload product images.
- Create, view, update, archive, and restore sponsors.
- View all customer orders.
- Accept confirmed orders.
- Refuse pending or confirmed orders.

## Technology Stack

### Backend

- PHP 8-compatible procedural PHP and classes.
- MySQL.
- PDO for database access.
- PHP sessions for authentication and cart/order context.
- Password hashing with `password_hash()` and verification with `password_verify()`.

### Frontend

- HTML and PHP templates.
- CSS and SCSS.
- Bootstrap-based layouts.
- JavaScript and jQuery.
- Font Awesome.
- Material Design Icons.
- Select2.
- Owl Carousel.
- Moment.js.
- DateRangePicker.
- DataTables and easing libraries in the dashboard/template assets.

There is no `composer.json`, `package.json`, framework dependency file, or automated test suite in the repository. Most frontend dependencies are already vendored under `inc/vendor` or included through template assets/CDN references.

## Application Architecture

The application follows a lightweight MVC-like structure:

```text
Request
  -> Router entry point
  -> Controller
  -> Model / PDO
  -> PHP view
  -> HTML response
```

The active application has three entry points:

1. `index.php` handles public pages.
2. `logged/index.php` handles authenticated customer pages.
3. `logged/admin/index.php` handles administrator pages.

The directory name `controlers` is intentionally preserved because it is the spelling used by the current application.

## Directory Structure

```text
.
|-- index.php                       Public router
|-- navbar.php                      Shared public navigation
|-- footer.php                      Shared public footer
|-- config/
|   `-- App.php                     Database constants (duplicate configuration)
|-- controlers/
|   |-- HomePageControler.php       Public home page
|   |-- LoginControler.php          Login workflow
|   |-- RegistrationControler.php   Registration workflow
|   |-- ResetPasswordControler.php  Password-reset workflow
|   `-- logged/
|       |-- HomePageControler.php   Customer pages
|       |-- CategoriesControler.php Category actions
|       |-- OrdersControler.php     Customer order actions
|       |-- ProductsControler.php   Product actions
|       |-- SponsorsControler.php   Sponsor actions
|       |-- UserControler.php       User/profile actions
|       `-- admin/
|           `-- AdminControler.php  Administrator pages and actions
|-- models/
|   |-- Database1.php               PDO singleton connection
|   |-- UserModel.php               Users and authentication data
|   |-- CategoriesModel.php         Category persistence
|   |-- ProductsModel.php           Product persistence
|   |-- OrdersModel.php             Order/cart persistence
|   `-- SponsorsModel.php            Sponsor persistence
|-- views/
|   |-- HomePageView.php            Public home page
|   |-- LoginView.php               Login form
|   |-- RegistrationView.php        Registration form
|   |-- ResetPasswordRequestView.php Reset request form
|   |-- ChangePasswordView.php      New password form
|   `-- logged/                     Customer and admin views
|-- logged/
|   |-- index.php                   Customer router
|   |-- disconnect.php              Logout endpoint
|   |-- header.php                  Customer shared header
|   |-- footer.php                  Customer shared footer
|   |-- actions/                    Legacy customer order scripts
|   |-- admin/                      Administrator router and interface
|   `-- done/                       Older template pages and remnants
|-- inc/
|   |-- css/                        Public stylesheets
|   |-- js/                         Public JavaScript
|   |-- logged/                     Customer/admin assets and styles
|   |-- vendor/                     Vendored frontend libraries
|   |-- assets/                     General image assets
|   `-- mail/                       Contact-form template assets
|-- temp/                           Older standalone authentication scripts
`-- README.md
```

## Routing Reference

All routes use query-string actions. The examples below assume the application is served at `http://localhost:8000`.

### Public routes

| URL | Purpose |
| --- | --- |
| `/index.php` | Public home page |
| `/index.php?action=login` | Login page |
| `/index.php?action=register` | Registration page |
| `/index.php?action=resetpassword` | Password-reset request page |
| `/index.php?action=changepassword` | Set a new password after verification |

### Customer routes

These pages are intended for authenticated users.

| URL | Purpose |
| --- | --- |
| `/logged/index.php` | Customer home page |
| `/logged/index.php?action=products&id=<category_id>` | Products in a category |
| `/logged/index.php?action=productview&id=<product_id>` | Product details |
| `/logged/index.php?action=currentcart` | Current pending cart |
| `/logged/index.php?action=orderlist` | Customer order history |
| `/logged/index.php?action=profile` | Customer profile |
| `/logged/index.php?action=editprofile` | Edit customer profile |
| `/logged/index.php?action=vieworderdetail&id=<order_id>` | Order details |
| `/logged/disconnect.php` | Log out |

### Administrator routes

These pages require a user whose role is `admin`.

| URL | Purpose |
| --- | --- |
| `/logged/admin/index.php` | Administrator dashboard |
| `?action=categories` | Category list |
| `?action=addcategory` | Add category |
| `?action=viewcategory&id=<id>` | View category |
| `?action=modifycategory&id=<id>` | Modify category |
| `?action=products` | Product list |
| `?action=addproduct` | Add product |
| `?action=viewproduct&id=<id>` | View product |
| `?action=modifyproduct&id=<id>` | Modify product |
| `?action=sponsors` | Sponsor list |
| `?action=addsponsor` | Add sponsor |
| `?action=viewsponsor&id=<id>` | View sponsor |
| `?action=modifysponsor&id=<id>` | Modify sponsor |
| `?action=orders` | All orders |
| `?action=vieworder&id=<id>` | Order details and administration |

For the administrator table above, prepend `/logged/admin/index.php` to each query string, for example `/logged/admin/index.php?action=products`.

## User Workflows

### Registration

The registration form collects:

- First name and last name.
- Email address.
- Password.
- Gender.
- Birthday.
- Security question.
- Security answer.

The registration controller checks whether the email already exists and then calls `UserModel`. Passwords are stored using bcrypt through PHP's `password_hash()` function.

### Login

The login process checks the submitted email and password using `UserModel`. A successful login stores the account email in `$_SESSION["login"]` and redirects to the authenticated customer area. Failed login information is stored in the session and displayed by the login view.

### Password reset

The reset process is based on the registered email, security question, and security answer:

1. The visitor submits the reset request form.
2. The account data is checked by `UserModel`.
3. The verified email is stored in `$_SESSION["changing"]`.
4. The visitor submits a replacement password.
5. The replacement password is hashed and saved.

### Logout

`logged/disconnect.php` clears and destroys the PHP session before redirecting to the login route.

## Shop and Order Workflow

1. A customer signs in and opens the customer home page.
2. Categories and product previews are loaded from the database.
3. A category page filters products by category and active status.
4. A product page displays product information and variant choices.
5. The customer submits a product, size, color, and quantity to the cart/order action.
6. A pending order row represents the cart item.
7. The cart calculates item totals and displays a fixed shipping value of `10 DT`.
8. Confirming the cart changes the customer's pending items to `confirmed`.
9. The customer can inspect the order history and individual order details.
10. Administrators can accept or refuse orders from the dashboard.

Observed order statuses include `pending`, `confirmed`, `cancelled`, `Accepted`, and `Refused`. The capitalization is not consistent throughout the current codebase and should be standardized before adding integrations or reporting logic.

The current project does not implement payment processing, stock reservation, inventory decrementing, shipping-provider integration, discount calculation beyond product promotion fields, or customer reviews.

## Database

### Connection settings

The active PDO connection is in `models/Database1.php`:

| Setting | Current value |
| --- | --- |
| Host | `localhost` |
| Database | `phpproject1` |
| User | `root` |
| Password | `hello` |

These values are hardcoded in the current source and should be changed for any shared or production environment. `config/App.php` contains a second copy of database constants but is not the connection used by `Database1.php`.

### Required tables

The repository contains no SQL dump or migration files. The following schema is inferred from model queries and view usage; exact types, indexes, defaults, and foreign keys must be confirmed before creating the production database.

#### `users`

| Column used by the application | Purpose |
| --- | --- |
| `id` | User identifier |
| `first_name` | First name |
| `last_name` | Last name |
| `email` | Login and order owner |
| `password` | Bcrypt password hash |
| `gender` | Profile gender |
| `birthday` | Date of birth |
| `security_question` | Password-reset question |
| `security_answer` | Password-reset answer |
| `photo` | Profile photo path/name |
| `created_at` | Registration timestamp |
| `role` | User role; administrators use `admin` |

#### `categories`

| Column used by the application | Purpose |
| --- | --- |
| `id` | Category identifier |
| `name` | Category name |
| `poster` | User/admin associated with the action |
| `posting_date` | Creation timestamp |
| `status` | Active/archive state |
| `modified_by_name` | Last editor |
| `modified_by_time` | Last modification timestamp |

#### `products`

| Column used by the application | Purpose |
| --- | --- |
| `id` | Product identifier |
| `name` | Product name |
| `category` | Category identifier used by application queries |
| `price` | Base product price |
| `poster` | User/admin associated with the action |
| `description` | Product description |
| `promo` | Promotion or discounted-price field |
| `sizes` | Available sizes |
| `colors` | Available colors |
| `photo` | Product image path/name |
| `posting_date` | Creation timestamp |
| `status` | Active/archive state |
| `modified_by_name` | Last editor |
| `modified_by_time` | Last modification timestamp |

#### `orders`

| Column used by the application | Purpose |
| --- | --- |
| `id` | Order/cart row identifier |
| `product` | Product identifier |
| `size` | Selected size |
| `color` | Selected color |
| `poster` | Customer email/account identifier |
| `quantity` | Requested quantity |
| `posting_date` | Order/cart timestamp |
| `status` | Cart/order state |

#### `sponsors`

| Column used by the application | Purpose |
| --- | --- |
| `id` | Sponsor identifier |
| `photo` | Sponsor image path/name |
| `poster` | User/admin associated with the action |
| `name` | Sponsor name |
| `posting_date` | Creation timestamp |
| `status` | Active/archive state |

The application treats `products.category` as a category ID, but the repository does not provide a confirmed foreign-key definition. Create foreign keys only after verifying the existing data and expected delete/archive behavior.

## Local Installation

### Requirements

- PHP 8 or a compatible PHP version.
- PDO and PDO MySQL extensions enabled.
- MySQL or MariaDB.
- A web server capable of serving PHP, such as PHP's built-in server or Apache.
- A browser with JavaScript enabled.

### 1. Get the source

Clone the repository or place the project directory in the document root of your local PHP server.

```powershell
git clone <repository-url>
Set-Location <project-directory>
```

### 2. Create the database

Create a MySQL database named `phpproject1`:

```sql
CREATE DATABASE phpproject1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

The project does not include the table-creation SQL. Create the tables listed in the Database section from a compatible schema, or obtain the original schema from the project owner.

### 3. Configure the database connection

Edit `models/Database1.php` and replace the development credentials as needed:

```php
const DB_NAME = 'phpproject1';
const DB_USER = 'root';
const DB_PASS = 'hello';
const DB_HOST = 'localhost';
```

Do not commit real passwords or production credentials to GitHub. A production version should load these values from environment variables or a server-side configuration file outside the repository.

### 4. Prepare upload directories

The PHP process needs write permission for the directories used by uploads:

- `inc/logged/img/products/`
- `inc/logged/img/profilephotos/`
- `inc/logged/img/sponsors/`

The exact upload behavior depends on the active controller and form implementation.

### 5. Create an administrator

Register a normal account, then set its database role to `admin` using a trusted database connection:

```sql
UPDATE users
SET role = 'admin'
WHERE email = 'admin@example.com';
```

Use the actual email of the account you created. The administrator interface checks the role stored on the user record.

### 6. Start the development server

From the project root, run:

```powershell
php -S localhost:8000 -t .
```

Open [http://localhost:8000/](http://localhost:8000/) in a browser.

Starting the server from the project root is important because the application uses relative `require_once` paths.

### Apache deployment

The project can also be served through Apache. Configure the project directory as the virtual host's document root, enable PHP and PDO MySQL, and ensure that the web server user can read the application and write to the upload directories. Do not expose database credentials or development-only files publicly.

## Assets and Templates

Frontend resources are split across the following locations:

- `inc/css/` and `inc/js/`: public styles and scripts.
- `inc/logged/css/`, `inc/logged/js/`, and `inc/logged/scss/`: customer-area assets.
- `inc/logged/admin/`: dashboard-specific styles, scripts, images, libraries, and SCSS.
- `inc/vendor/`: local jQuery, Font Awesome, Material Design Icons, Select2, and datepicker resources.
- `inc/lib/`: carousel, easing, and other template libraries.
- `inc/logged/img/`: product, profile, sponsor, and dashboard images.

The `logged/done` and `logged/admin/done` directories contain older EShopper and Dashmin template pages, including their original template readme and license files. These pages are not the primary routed application surface and should be treated as legacy/template material unless a specific page is wired into a route.

## Security Notes

The current code should be treated as development code until the following issues are addressed:

- Database credentials are hardcoded.
- CSRF tokens are not consistently present on forms.
- Some output is rendered without HTML escaping.
- Upload validation is incomplete, especially for sponsor uploads.
- Password-reset security answers are stored and compared in plaintext.
- Some redirects do not stop execution with `exit`.
- Role and ownership checks are distributed across views/controllers and should be centralized.
- Several legacy and active scripts use different route conventions.
- Some old links still point to static template pages or placeholder `#` targets.
- Registration does not fully validate confirmation email and repeat-password fields.
- Order status values use inconsistent capitalization.

Before deployment, use environment-based secrets, strict upload validation, CSRF protection, output escaping, server-side authorization, consistent redirects, input validation, prepared statements everywhere, and a reviewed database schema with foreign keys and indexes.

## Known Codebase Limitations

- No SQL schema or seed data is included.
- No Composer or dependency lock file is included.
- No automated unit, integration, or browser tests are included.
- The active and legacy implementations coexist under `logged/`, `logged/done/`, and `logged/admin/done/`.
- Some older scripts reference files that are not present in the current root structure.
- Some redirects use outdated paths such as `login.php`, `products.php`, or `categories.php` instead of the routed URLs.
- Product update code and some older controller include paths require review before relying on every administration action.
- Customer home-page product previews may not apply the same active-status filtering as category pages.
- The cart uses a fixed shipping value of `10 DT`.
- There is no payment gateway, stock control, shipping workflow, email order notification, or review system.
- The contact form includes template/demo behavior and an `API_TOKEN` placeholder.

## Recommended Development Workflow

1. Start MySQL and confirm that the configured database exists.
2. Start the PHP development server from the repository root.
3. Test the public registration and login flow.
4. Test product browsing and category filtering as a customer.
5. Test add-to-cart, confirmation, cancellation, and order history.
6. Test administrator category, product, sponsor, and order actions.
7. Check upload directories after every upload-related change.
8. Run PHP syntax checks on changed files before committing.
9. Review route redirects and session authorization for every new action.
10. Never commit real database passwords, uploaded private files, or production configuration.

## Contributing

When contributing:

- Keep changes focused on the active routed application.
- Preserve the existing route and model conventions unless a migration is planned.
- Use prepared SQL statements and server-side validation for new features.
- Escape values when rendering user-controlled data.
- Add or update documentation when adding routes, tables, or configuration.
- Test both customer and administrator permissions.
- Avoid committing generated uploads and local credentials.

## License and Third-Party Templates

The repository does not declare a single project-level license. It includes third-party template assets and license/readme files, including EShopper and Dashmin materials. Review the existing third-party license files before redistributing the application or its assets.

## Contact

For project-specific questions, contact the repository owner or maintainer. The current codebase does not define a dedicated issue template, contribution policy, or support channel.

## Videos

<a href="https://www.youtube.com/watch?v=G7rYpe7j6kg" target="_blank">
  Part 1
</a> <br>

<a href="https://www.youtube.com/watch?v=Qrc5TNHoKis" target="_blank">
  Part 2
</a> <br>

<a href="https://www.youtube.com/watch?v=03Ky6Xtmvfk" target="_blank">
  Part 3
</a> <br>

<a href="https://www.youtube.com/watch?v=kDWXOOwh2Yg" target="_blank">
  Part 4
</a>