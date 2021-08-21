# #Overview 
Assume that you want to test an **Imports feature** in your system, by using different types of the imported files such as CSV, XLS, XLSX.

# #Problem 
 - In your case if you want to test the imports scenarios with different types of files you must have previously created **hard files**.
 - It's too long and very exhausting process to create a huge number of hard files manually to cover your test cases with different scenarios.

# #Solution
In this repository I've implement a simple solution using the **Laravel Excel Package** ( that you in most using it to import or export ) to generate a files dynmaicly with dynmaic content. by using **Laravel Storage Fake** and **Laravel Excel Exportable Class** on the fly.

### Built With
 - Laravel 8.
 - Laravel Form Request.
 - PHP 7.4.
 - PHP Traits.
 - Laravel Excel
 - PHPUnit.
 
Built like a Package to group all these parts together, and you can view the whole work inside this directory 
 
> Please visit [Faker Uploaded Instance Files With Dynamic Content On the fly ] () to view only changes.

### License 

> Free to use.
