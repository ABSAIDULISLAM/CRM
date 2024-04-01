<?php
namespace App\Enums;

enum Status :string
{
    case Admin = "admin";
    case OfficeStaff = "office_staff";
    case MarketingStaff = "marketing_staff";
    case SuperAdmin = "super_admin";
    case User = 'user';
    case Rejected = "rejected";
    case Progress = "progress";
    case Delivered = "delivered";
    case Cancel = "cancel";
    case Hold = 'hold';
    case Success = 'success';
    case Pending = "pending";
    case Completed = "completed";
    case Paid = "paid";
    case Unpaid = "unpaid";
    case Partial = "partial";
    case Active = "active";
    case Deactive = "deactive";
    case On = "on";
    case Off = "off";
    case Online = "online";
    case Offline = "offline";
    case Person = "person";
    case Org = "org";
    case High = "high";
    case Medium = "medium";
    case Low = "low";
    case Closed = "closed";
    case Monthly = "monthly";
    case Yearly = "yearly";
    case Estimate = "estimate";
    case Invoice = "invoice";
    case Cash_on = "cash_on";
    case Card = "card";
    case Bkash = "bkash";
    case Nagod = "nagod";
    case Income = "income";
    case Expense = "expense";

}
