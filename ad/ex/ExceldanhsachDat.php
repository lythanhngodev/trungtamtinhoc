<?php
session_start();
if (!isset($_SESSION['_checkpage'])) {echo "<h2>Đâu dễ phá vậy</2>";die();}
if(!isset($_GET['idds']) || empty($_GET['idds'])){
    echo "Không có dữ liệu";
    exit();
}
function getNameFromNumber($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2) . $letter;
    } else {
        return $letter;
    }
}
require_once '../../__.php';
include_once "../ec/PHPExcel.php";
$kn = new clsKetnoi();
$danhsach = intval($_GET['idds']);
$objPHPExcel = new PHPExcel;
$numberSheet = 0;
$objPHPExcel->setActiveSheetIndex($numberSheet);
$tenfile = "KQHT DAT ".date('d-m-Y');
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
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C1:I4');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('J1:M1');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('J2:M2');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('J3:M3');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('J4:M4');

$objPHPExcel->getActiveSheet()->getStyle("I1:M4")->getFont()->setSize(13);
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);

$sheet->setCellValue("C1","DANH SÁCH THI SINH ĐẠT YÊU CẦU\nCẤP CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN");
$objPHPExcel->getActiveSheet()->getStyle('C1')->getAlignment()->setWrapText(true);
$sheet->setCellValue("J1","Mã số: BM-IC-19-00");
$sheet->setCellValue("J2","Ngày hiệu lực: 04/7/2018");
$sheet->setCellValue("J3","Lần soát xét: 00");
$sheet->setCellValue("J4","Trang:1/...");

$sheet->getStyle('A1:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle("C1:I4")->getFont()->setBold(true);
$sheet->getStyle('A1:M4')
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A5:M5');
$sheet->setCellValue("A5","KỲ THI CẤP CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN CƠ BẢN");
$objPHPExcel->getActiveSheet()->getStyle("A5")->getFont()->setSize(14);
$sheet->getStyle('A5:M5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A5:M5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->getStyle('I1:M4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A6:M6');
$sheet->setCellValue("A6","Khóa ... , ngày ...");
$objPHPExcel->getActiveSheet()->getStyle("A6")->getFont()->setSize(14);

$sheet->getStyle('A6:M8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A6:M8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A7:A8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B7:B8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C7:C8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('D7:E8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F7:F8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('G7:G8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('H7:H8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('I7:J7');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('K7:K8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('L7:L8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('M7:M8');

$sheet->setCellValue("A7","STT");
$sheet->setCellValue("B7","SBD");
$sheet->setCellValue("C7","Số CMND");
$sheet->setCellValue("D7","Họ tên");
$sheet->setCellValue("F7","Ngày sinh");
$sheet->setCellValue("G7","Giới\ntính");
$sheet->setCellValue("H7","Nơi sinh");
$sheet->setCellValue("I7","Điểm thi");
$sheet->setCellValue("I8","LT");
$sheet->setCellValue("J8","TH");
$sheet->setCellValue("K7","Tổng\nđiểm");
$sheet->setCellValue("L7","Kết\nquả");
$sheet->setCellValue("M7","Ghi chú");

$objPHPExcel->getActiveSheet()->getStyle('A7:M8')->getAlignment()->setWrapText(true);

$sheet->setCellValue("E4","Điểm quá trình");
$sheet->setCellValue("F4","Điểm giữa kỳ");
$sheet->setCellValue("G4","Điểm cuối kỳ");

$objPHPExcel->getActiveSheet()->getStyle("A7:M8")->getFont()->setBold(true);

$sheet->getStyle('A7:M8')
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));
$objPHPExcel->getActiveSheet()->getStyle('A7:M8')->getFill()->applyFromArray(array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'b9b9b9'
    )
));
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(21);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);

$diemkhoa = $kn->query("SELECT DISTINCT hv.IDHV,hv.HO, hv.TEN, hv.NGAYSINH, hv.GIOITINH, hv.NOISINH, hv.CMND, hv.MSSV,ds.TENDS,dh.DIEMLT,dh.DIEMTH,dh.TONGDIEM,dh.SBD,dh.IDPT,dh.IDDS,dh.GHICHUD FROM danhsachdangkyduthi ds LEFT JOIN danhsachdangkyduthi_hocvien dh ON ds.IDDS=dh.IDDS LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dh.IDDS='$danhsach' AND (dh.DIEMLT >= 5.0 AND dh.DIEMTH >=5.0) ORDER BY dh.SBD ASC;");
$ds = null;
while ($row = mysqli_fetch_assoc($diemkhoa)){
    $ds[] = $row;
}
$dong = 9;
$sokhongdat=0;
$sodat=0;
for ($i=0; $i < count($ds); $i++) { 
    $ngaythang = $ds[$i]['NGAYSINH'];
    if (strlen($ngaythang)==4) {
        $ngaythang = date_format(date_create_from_format('Y', $ngaythang), 'Y');
    } else
    if (strlen($ngaythang)>4&&strlen($ngaythang)<=7) {
        $ngaythang = date_format(date_create_from_format('m/Y', $ngaythang), 'm/Y');
    }
    else{
        $ngaythang = date_format(date_create_from_format('d/m/Y', $ngaythang), 'd/m/Y');
    }
    $sheet->setCellValue("A".$dong,$i+1);
    $sheet->setCellValue("B".$dong,$ds[$i]['SBD']);
    $sheet->setCellValue("C".$dong,$ds[$i]['CMND']);
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('D'.$dong.':E'.$dong);
    $sheet->setCellValue("D".$dong,$ds[$i]['HO']." ".$ds[$i]['TEN']);
    $sheet->setCellValue("F".$dong,$ngaythang);
    $sheet->setCellValue("G".$dong,$ds[$i]['GIOITINH']);
    $sheet->setCellValue("H".$dong,$ds[$i]['NOISINH']);
    $sheet->setCellValue("I".$dong,$ds[$i]['DIEMLT']);
    $sheet->setCellValue("J".$dong,$ds[$i]['DIEMTH']);
    $sheet->setCellValue("K".$dong,$ds[$i]['TONGDIEM']);
    $dat = "Không đạt";
    if (floatval($ds[$i]['DIEMLT']) >= 5.0 && floatval($ds[$i]['DIEMTH']) >=5.0) {
        $dat = "Đạt";$sodat++;
    }
    else{
        $sokhongdat++;
    }
    $sheet->setCellValue("L".$dong,$dat);
    $sheet->setCellValue("M".$dong,$ds[$i]['GHICHUD']);
    $dong++;
}
$sheet->getStyle('A9:M'.($dong-1))
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));

$objPHPExcel->getActiveSheet()->getStyle('I9:K'.($dong-1))->getNumberFormat() ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$objPHPExcel->getActiveSheet()->getStyle('I9:K'.($dong-1))->getNumberFormat() ->setFormatCode('#,##0.0'); // kết quả dạng 36,774.2
$sheet->getStyle('A7:C'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A7:C'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('F7:L'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('F7:L'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('I9:L'.($dong-1))->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A7:M'.($dong+5))->getFont()->setSize(12);

// Phần tổng kết
$objPHPExcel->getActiveSheet()->getRowDimension($dong)->setRowHeight(20);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A'.$dong.':M'.$dong);
$sheet->setCellValue("A".$dong,"Danh sách có ".($dong-9)." thí sinh.");
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getFont()->setItalic(true);
$sheet->getStyle('A'.$dong.':M'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

// Phần ngày tháng năm
$dong++;
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('H'.$dong.':M'.$dong);
$sheet->setCellValue("H".$dong,"Vĩnh Long, ngày ".date('d')." tháng ".date('m')." năm ".date('Y'));
$objPHPExcel->getActiveSheet()->getStyle('H'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('H'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('H'.$dong)->getFont()->setItalic(true);
// Phần ký tên
$dong+=2;
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A'.$dong.':D'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E'.$dong.':H'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('J'.$dong.':M'.$dong);
$sheet->setCellValue("A".$dong,"CHỦ TỊCH HỘI ĐỒNG THI");
$sheet->setCellValue("E".$dong,"TRƯỞNG BAN CHẤM THI");
$sheet->setCellValue("J".$dong,"NGƯỜI GHI ĐIỂM");
$sheet->getStyle('A'.$dong.':J'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A'.$dong.':J'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong.':K'.$dong)->getFont()->setBold(true);
$dong++;
// ký và ghi họ tên
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B'.$dong.':C'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E'.$dong.':H'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('J'.$dong.':M'.$dong);
$sheet->setCellValue("B".$dong,"(Ký và ghi rõ họ tên)");
$sheet->setCellValue("E".$dong,"(Ký và ghi rõ họ tên)");
$sheet->setCellValue("J".$dong,"(Ký và ghi rõ họ tên)");
$objPHPExcel->getActiveSheet()->getStyle('B'.$dong.':K'.$dong)->getFont()->setItalic(true);
$sheet->getStyle('B'.$dong.':J'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B'.$dong.':J'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
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