<?php

namespace App\Exports;

use App\Models\Inquiry;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class InqueriesExport implements FromQuery, WithHeadings, WithColumnFormatting , WithStyles

{
    protected $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function query()
    {
            if(!empty($this->code)){

                $tomorrow = Carbon::tomorrow()->toDateString();
                return  Inquiry::select('customer_name', 'phone', 'phone2', 'national_id', 'inquiry_type','code', 'code2', 'address', 'address2','job', 'city','product')
                 ->where('date_out' ,'=', null)
                ->where('status','=','Pending')
                ->where('date_pending', '=',$tomorrow)
                ->where(function($query) {
                    $query->where('code', $this->code)
                          ->orWhere('code2', $this->code)
                          ;
                });
            }


    }

    public function headings() : array {

        return [
            'اسم العميل',
            'موبايل1',
            'موبايل2',
            'الرقم القومي',
            'نوع الاستعلام',
            'كود1',
            'كود2',
            'العنوان1',
            'العنوان2',
            'الوظيفة',
            'المحافظة',
            'المنتج',
            'موقف العميل',
        ];
    }

    public function styles(Worksheet $sheet)
    {

        $headerCells = '1:1'; // تعديل رأس الصفحة

        // لون الخلفية الأخضر
        $sheet->getStyle($headerCells)->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '00B050'] // لون أخضر RGB
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF'], // لون النص أبيض
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        ]);



        // تطبيق نمط على الصفوف والعناوين
        $sheet->getStyle('1:1')->getFont()->setBold(true); // جعل العناوين عريضة
        // تعيين اتجاه الورقة من اليمين إلى الشمال
        $sheet->setRightToLeft(true);
        // تعديل عرض الأعمدة لتوفير مسافة بين كل عمود
        foreach ($sheet->getColumnDimensions() as $columnDimension) {
            $columnDimension->setAutoSize(true);
        }
        foreach (range('A', 'M') as $columnID) {
            $sheet->getColumnDimension($columnID)->setWidth(20); // تعيين عرض العمود إلى 20، يمكنك تعديل القيمة حسب الحاجة
        }
        // محاذاة القيم في المركز
        $sheet->getStyle('A:M')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER, // موبايل1
            'C' => NumberFormat::FORMAT_NUMBER, // موبايل2
            'D' => NumberFormat::FORMAT_NUMBER, // الرقم القومي
            'E' => NumberFormat::FORMAT_TEXT, // نوع الاستعلام
            'F' => NumberFormat::FORMAT_TEXT, // كود1
            'G' => NumberFormat::FORMAT_TEXT, // كود2
            'H' => NumberFormat::FORMAT_TEXT, // العنوان1
            'I' => NumberFormat::FORMAT_TEXT, // العنوان2
            'J' => NumberFormat::FORMAT_TEXT, // المحافظة
            'K' => NumberFormat::FORMAT_TEXT, // الوظيفة
            'L' => NumberFormat::FORMAT_TEXT, // المنتج
            // تاريخ يمكن تنسيقه كـ تاريخ
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY, // تاريخ
            // عمود موقف العميل يمكن أن يضاف إذا لزم الأمر
        ];
    }
}

/* 'B'
'C'
'D'
'F'
'G'
'H'
'I'
'J'
'K'
'L'
 */
