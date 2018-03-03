# pure-php-registration
Pure PHP & MySQL Registration form which send (plain text) email to the admin. Developed as simple MVC (Model-View-Controller) software architecture. A simple PHP & Web application.

Small web application using PHP, MySQL and Bootstrap 4.x.
A new user enter his personal data on a registration form.

• Salutation
• First given name
• Surname
• Road
• House number
• Post Code
• City
• e-mail address (also unique login name)
• Promotion code
• Date of birth

A list of valid promotion codes is stored in an entity. If an invalid promotion code is entered, an error is issued and the user's registration fail.

If the registration passes without errors, it is set the score according to the promotion code of the user (integer). Example values for promotion code and score can be chosen freely.

The score of the registration should be mentioned in the following e-mail to the user.

Depending on the browser language of the user, the confirmation e-mail should be sent to the user with the confirmation link in the selected language, whereby only English and German are available as languages. The language variant English serves as fallback.
