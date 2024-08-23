<?php
namespace App\Enums;
use App\Models\Inquiry;

enum InquiryStatus:int
{
    case home = 1;
    case work = 2;
    case home_work = 3;
    case home_guarantor = 4;
    case work_guarantor = 5;
    case home_guarantor_work_guarantor = 6;
    case home_buyer_guarantor = 7;
    case work_buyer_guarantor = 8;



    public function InquiryStatus()
        {
            return match($this)
                {
                    self::home => 'المنزل',
                    self::home => 'العمل',
                    self::home => 'عمل+منزل',
                    self::home => 'منزل ضامن',
                    self::home => 'عمل ضامن',
                    self::home => 'منزل + عمل ضامن',
                    self::home => 'عمل مشتري + ضامن',
                };
        }

}


?>
