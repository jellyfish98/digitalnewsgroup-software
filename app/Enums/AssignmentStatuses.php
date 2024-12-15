<?php

namespace App\Enums;

enum AssignmentStatuses: string
{
    case NEW = 'New';
    case ASSIGNED = 'Assigned';
    case UNASSIGNED = 'Unassigned';
    case WAITING_FOR_APPROVAL = 'Waiting for approval';
    case CUSTOMER_APPROVED = 'Customer approved';
    case CUSTOMER_REJECTED = 'Customer rejected';
    case SENT_TO_SUPPLIER = 'Sent to supplier';
    case DONE = 'Done';
}
