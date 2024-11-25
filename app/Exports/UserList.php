<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class UserList implements FromView, WithHeadings, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($data, $filter)
    {
        $this->data = $data;
        $this->filter = $filter;
        //        $this->endDate = $endDate;
    }

    public function headings(): array
    {
        return [
            'Transaction Code',
            'Order Code',
            'Agent Delivery',
            'Type',
            'To',
            'Status Kirim',
            'Pickup Time',
            'Recieved Time',
        ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $columnStart = 'A';
                $rowStart = 5;

                $columnEnd = 'L';
                $rowEnd = $rowStart + $this->data->count();


                $cellRange = 'A2:L2'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setName('Calibri');
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);


                $event->sheet->getDelegate()->getStyle("$columnStart$rowStart:$columnEnd$rowStart")->applyFromArray([
                    'fill' => [
                        'fillType' => 'solid',
                        'rotation' => 0,
                        'color' =>
                        ['rgb' => 'D9D9D9'],
                    ],
                    'row' => [
                        'height' => '20'
                    ]
                ]);


                $event->sheet->getDelegate()->getStyle("$columnStart$rowStart:$columnEnd$rowEnd")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    ],
                ]);

                foreach (range("$columnStart", "$columnEnd") as $v) {
                    $event->sheet->getColumnDimension("$v")->setAutoSize(true);
                }
            },
        ];
    }

    public function view(): View
    {
        // dd($this->data);
        // $content = view('admin.contents.export.user', [
        //     'reportOrder' => $this->data,
        //     'filter' => $this->filter
        // ])->render();
        // print_r($content);
        // die;
        return view('admin.contents.export.user', [
            'reportOrder' => $this->data,
            'filter' => $this->filter
        ]);
    }
}
