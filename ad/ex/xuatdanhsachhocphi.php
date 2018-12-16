<?php
session_start();
if (!isset($_SESSION['_checkpage'])) {echo "<h2>Đâu dễ phá vậy</2>";die();}
if(!isset($_GET['khoa']) || empty($_GET['khoa'])){
    echo "Không có dữ liệu";
    exit();
}
function doctien( $number )
{
    $hyphen = ' ';
    $conjunction = '  ';
    $separator = ' ';
    $negative = 'am ';
    $decimal = ' phay ';
    $dictionary = array(
        0 => 'khong',
        1 => 'mot',
        2 => 'hai',
        3 => 'ba',
        4 => 'bon',
        5 => 'nam',
        6 => 'sau',
        7 => 'bay',
        8 => 'tam',
        9 => 'chin',
        10 => 'muoi',
        11 => 'muoi mot',
        12 => 'muoi hai',
        13 => 'muoi ba',
        14 => 'muoi bon',
        15 => 'muoi nam',
        16 => 'muoi sau',
        17 => 'muoi bay',
        18 => 'muoi tam',
        19 => 'muoi chin',
        20 => 'hai muoi',
        30 => 'ba muoi',
        40 => 'bon muoi',
        50 => 'nam muoi',
        60 => 'sau muoi',
        70 => 'bay muoi',
        80 => 'tam muoi',
        90 => 'chin muoi',
        100 => 'tram',
        1000 => 'ngan',
        1000000 => 'trieu',
        1000000000 => 'ty',
        1000000000000 => 'nghin ty',
        1000000000000000 => 'ngan trieu trieu',
        1000000000000000000 => 'ty ty'
    );
    if( !is_numeric( $number ) )
    {
        return false;
    }
    if( ($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX )
    {
        // overflow
        trigger_error( 'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING );
        return false;
    }
    if( $number < 0 )
    {
        return $negative . doctien( abs( $number ) );
    }
    $string = $fraction = null;

    if( strpos( $number, '.' ) !== false )
    {
        list( $number, $fraction ) = explode( '.', $number );
    }
    switch (true)
    {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int)($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if( $units )
            {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if( $remainder )
            {
                $string .= $conjunction . doctien( $remainder );
            }
            break;
        default:
            $baseUnit = pow( 1000, floor( log( $number, 1000 ) ) );
            $numBaseUnits = (int)($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = doctien( $numBaseUnits ) . ' ' . $dictionary[$baseUnit];
            if( $remainder )
            {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= doctien( $remainder );
            }
            break;
    }
    if( null !== $fraction && is_numeric( $fraction ) )
    {
        $string .= $decimal;
        $words = array();
        foreach( str_split((string) $fraction) as $number )
        {
            $words[] = $dictionary[$number];
        }
        $string .= implode( ' ', $words );
    }
    return ($string);
}
require_once '../../__.php';
include_once "../ec/PHPExcel.php";
$kn = new clsKetnoi();
$danhsach = intval($_GET['khoa']);
$objPHPExcel = new PHPExcel;
$numberSheet = 0;
$objPHPExcel->setActiveSheetIndex($numberSheet);
$tenfile = "BM-IC-32-00 - HPHV ".date('d-m-Y');
$sheet = $objPHPExcel->getActiveSheet()->setTitle($tenfile);
$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFill()->applyFromArray(array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'FFFFFF'
    )
));
$styleArray_de = array(
    'font'  => array(
        'name'  => 'Times New Roman'
    ));
$objPHPExcel->getActiveSheet()->getDefaultStyle()
->applyFromArray($styleArray_de);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A1:B4');

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('logo.png');
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objDrawing->setWidthAndHeight(90,90);
$objDrawing->setResizeProportional(true);
$objDrawing->setOffsetX(20);
$objDrawing->setOffsetY(8);
$styleArray = array(
    'font'  => array(
        'name'  => 'Times New Roman',
        'size' => 12
    ));
$objPHPExcel->getActiveSheet()
    ->getStyle( $objPHPExcel->getActiveSheet()->calculateWorksheetDimension() )
    ->applyFromArray($styleArray);  
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C1:F4');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('G1:H1');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('G2:H2');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('G3:H3');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('G4:H4');

$objPHPExcel->getActiveSheet()->getStyle("G1:H4")->getFont()->setSize(13);
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);

$sheet->setCellValue("C1","DANH SÁCH HỌC VIÊN NỘP  HỌC PHÍ");
$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setWrapText(true);
$sheet->setCellValue("G1","Mã số: BM-IC-32-00");
$sheet->setCellValue("G2","Ngày hiệu lực: 04/7/2018");
$sheet->setCellValue("G3","Lần soát xét: 00");

$sheet->getStyle('A1:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:F4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setBold(true);
$sheet->getStyle('A1:H4')
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A5:H5');
$sheet->setCellValue("A5","CÁC LỚP KỸ NĂNG SỬ DỤNG CÔNG NGHỆ THÔNG TIN CƠ BẢN\nKHOÁ ..... - Từ ngày ...... đến ngày .....");
$objPHPExcel->getActiveSheet()->getStyle('A5')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(60);
$objPHPExcel->getActiveSheet()->getStyle("A5")->getFont()->setSize(14);
$sheet->getStyle('A5:H5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A5:H5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->getStyle('A6:H6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A6:H6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B6:D6');

$sheet->setCellValue("A6","STT");
$sheet->setCellValue("B6","Họ và tên");
$sheet->setCellValue("E6","Mã số\nbiên lai");
$sheet->setCellValue("F6","Ngày ghi\nbiên lai");
$sheet->setCellValue("G6","Số tiền");
$sheet->setCellValue("H6","Ghi chú");

$objPHPExcel->getActiveSheet()->getStyle('A6:H8')->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle("A6:M6")->getFont()->setBold(true);

$sheet->getStyle('A6:H6')
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));
$objPHPExcel->getActiveSheet()->getStyle('A6:H6')->getFill()->applyFromArray(array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'b9b9b9'
    )
));

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);

$diemkhoa = $kn->query("
    SELECT DISTINCT hv.IDHV,hv.HO,hv.TEN, hvl.MASOBIENLAI,hvl.NGAYGHIBIENLAI,hvl.HOCPHI,kl.IDKH,hvl.GHICHUHP
    FROM
        hocvien_lop hvl
        LEFT JOIN khoahoc_lop kl ON hvl.IDL=kl.IDL
        LEFT JOIN hocvien hv ON hvl.IDHV=hv.IDHV
        WHERE kl.IDKH = '4';"
    );
$ds = null;
while ($row = mysqli_fetch_assoc($diemkhoa)){
    $ds[] = $row;
}
$dong = 7;
$tongtien=0;
for ($i=0; $i < count($ds); $i++) { 
    $sheet->setCellValue("A".$dong,$i+1);
    $sheet->setCellValue("B".$dong,$ds[$i]['HO']);
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B'.$dong.':C'.$dong);
    $sheet->setCellValue("D".$dong,$ds[$i]['TEN']);
    $sheet->setCellValue("E".$dong,$ds[$i]['MASOBIENLAI']);
    $sheet->setCellValue("F".$dong,$ds[$i]['NGAYGHIBIENLAI']);
    $sheet->setCellValue("G".$dong,$ds[$i]['HOCPHI']);
    $tongtien+=floatval($ds[$i]['HOCPHI']);
    $sheet->setCellValue("H".$dong,$ds[$i]['GHICHUHP']);
    $dong++;
}
$sheet->getStyle('A7:H'.($dong-1))
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));

$objPHPExcel->getActiveSheet()->getStyle('G7:G'.($dong-1))->getNumberFormat() ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$objPHPExcel->getActiveSheet()->getStyle('G7:G'.($dong-1))->getNumberFormat() ->setFormatCode('#,##0'); // kết quả dạng 36,774
$sheet->getStyle('E7:F'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('E7:F'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('A7:A'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A7:A'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A7:H'.($dong+5))->getFont()->setSize(12);

++$dong;

// Phần tổng kết
$objPHPExcel->getActiveSheet()->getRowDimension($dong)->setRowHeight(20);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A'.$dong.':H'.$dong);
$sheet->setCellValue("A".$dong,"Tổng số học viên: ".count($ds).".");
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getFont()->setItalic(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getFont()->setBold(true);
$sheet->getStyle('A'.$dong.':H'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

++$dong;
// Phần tổng kết tiền
$objPHPExcel->getActiveSheet()->getRowDimension($dong)->setRowHeight(20);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A'.$dong.':H'.$dong);
$sheet->setCellValue("A".$dong,"Tổng tiền lệ phí khóa học: ".ucfirst(doctien($tongtien))." đồng (Số tiền viết bằng chữ).");
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getFont()->setItalic(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getFont()->setBold(true);
$sheet->getStyle('A'.$dong.':H'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

// Phần ngày tháng năm
++$dong;
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E'.$dong.':H'.$dong);
$sheet->setCellValue("E".$dong,"Vĩnh Long, ngày ".date('d')." tháng ".date('m')." năm ".date('Y'));
$objPHPExcel->getActiveSheet()->getStyle('E'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('E'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('E'.$dong)->getFont()->setItalic(true);
// Phần ký tên
$dong+=2;
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A'.$dong.':B'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C'.$dong.':D'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E'.$dong.':F'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('G'.$dong.':H'.$dong);
$sheet->setCellValue("A".$dong,"Hiệu trưởng");
$sheet->setCellValue("C".$dong,"Phòng Ktoán - Tài vụ");
$sheet->setCellValue("E".$dong,"Trung tâm tin học");
$sheet->setCellValue("G".$dong,"Lập bảng");
$sheet->getStyle('A'.$dong.':H'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A'.$dong.':H'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('A'.$dong.':H'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A'.$dong.':H'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong.':H'.$dong)->getFont()->setBold(true);
$dong++;

// Save Excel 2007 file
#echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = New PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save("$tenfile.xlsx");
// We'll be outputting an excel file
header("Content-Disposition: attachment; filename=\"$tenfile.xlsx\"");
header('Content-type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
header('Content-Length: '.'$tenfile.xlsx');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: no-cache');
readfile("$tenfile.xlsx");
return;
?>