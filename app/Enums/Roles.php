<?php

namespace App\Enums;

enum Roles: string
{
    case ADMIN = 'Admin';
    case INTERN = 'Intern';
    case CUSTOMER = 'Customer';
    case CUSTOMER_ADMIN = 'Customer Admin';
    case EXTERN = 'Extern';
    case SALES = 'Sales';
    case DEVELOPER = 'Developer';
    case WRITER = 'Writer';
    case CONTENT_MANAGER = 'Content Manager';
    case SUPPLIER = 'Supplier';
}
