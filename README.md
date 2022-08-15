## Questions and Answers

App where user can answer questions with provided answers (only one of them is correct), without using framework, OOP.

---

User can start to answer questions only after providing his name and choosing question category.
Progress bar is showing progress, in which question user is at the moment.
Only one question answer is correct.
After all questions have been answered result will be displayed.
All user question answers are saved in database table. Final result with correct answer amount is also saved in database table.

---

### How to run App

* run command `composer install`
* configure/declare database connection credentials in `app/Connection`
* mysql dump file for database, tables and test data for questions and answers can be found in folder `app/SQL`
* if needed navigate to folder where `index.php` file is located 
* execute command `php -S localhost:8000`