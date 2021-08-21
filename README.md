<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">       </a>
</p>
<a  align="center" href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>

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
 
> Please visit [Faker Uploaded Instance Files With Dynamic Content On the fly ] (<a href="https://github.com/theizekry/faker-uploaded-instances-file-for-imports-tests/tree/master/app/FakerUploadedInstanceGenerator"> HERE </a>) to view only changes.

### Tests 
> You can take a look for feature tests with usage from here (<a href="https://github.com/theizekry/faker-uploaded-instances-file-for-imports-tests/blob/master/tests/Feature/UsersImportTest.php"> HERE </a>).
> The test cases cover the idea with dynamic content for CSV, XLS and XLSX files types.


### License 

> Free to use.
