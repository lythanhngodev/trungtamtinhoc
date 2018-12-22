<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['_checkpage'])) {echo "<h2>Đâu dễ phá vậy</2>";die();}
if(!isset($_GET['idpk']) || empty($_GET['idpk'])){
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
$danhsach = intval($_GET['idpk']);
$objPHPExcel = new PHPExcel;
$numberSheet = 0;
$objPHPExcel->setActiveSheetIndex($numberSheet);
$tenfile = "Nhap diem PK ".date('d-m-Y');
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

$sheet->setCellValue("C1","KẾT QUẢ CHẤM PHÚ KHẢO");
$sheet->setCellValue("J1","Mã số: BM-IC-25-00");
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
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C7:D8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E7:E8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F7:F8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('G7:G8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('H7:I7');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('J7:K7');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('L7:L8');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('M7:M8');

$sheet->setCellValue("A7","STT");
$sheet->setCellValue("B7","SBD");
$sheet->setCellValue("C7","Họ tên");
$sheet->setCellValue("E7","Ngày\nsinh");
$sheet->setCellValue("F7","Giới\ntính");
$sheet->setCellValue("G7","Nơi sinh");
$sheet->setCellValue("H7","Điểm LT");
$sheet->setCellValue("J7","Điểm TH");
$sheet->setCellValue("H8","trước\nPK");
$sheet->setCellValue("I8","sau\nPK");
$sheet->setCellValue("J8","trước\nPK");
$sheet->setCellValue("K8","sau\nPK");
$sheet->setCellValue("L7","Điểm\nTB\nsau PK");
$sheet->setCellValue("M7","Kết quả");

$objPHPExcel->getActiveSheet()->getStyle('A7:M8')->getAlignment()->setWrapText(true);

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
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(11);
$objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(20);


$diemkhoa = $kn->query("
SELECT DISTINCT dh.SBD,CONCAT(hv.HO,' ',hv.TEN) AS HOTEN, hv.NGAYSINH,hv.GIOITINH, hv.NOISINH,pk.TENPK,dh.DIEMLT,dh.DIEMTH
FROM danhsachphuckhao_hocvien dk
    LEFT JOIN danhsachphuckhao pk ON dk.IDPK=pk.IDPK
    LEFT JOIN danhsachdangkyduthi_hocvien dh ON dh.IDDKTHV=dk.IDDKTHV
    LEFT JOIN danhsachdangkyduthi ds ON ds.IDDS=dh.IDDS
    LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dk.IDPK='$danhsach' ORDER BY dh.SBD ASC;");
$ds = null;
while ($row = mysqli_fetch_assoc($diemkhoa)){
    $ds[] = $row;
}
$dong = 9;
$sokhongdat=0;
$sodat=0;
for ($i=0; $i < count($ds); $i++) { 
    $sheet->setCellValue("A".$dong,$i+1);
    $sheet->setCellValue("B".$dong,$ds[$i]['SBD']);
    $sheet->setCellValue("C".$dong,$ds[$i]['HOTEN']);
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C'.$dong.':D'.$dong);
    $sheet->setCellValue("E".$dong,$ds[$i]['NGAYSINH']);
    $sheet->setCellValue("F".$dong,$ds[$i]['GIOITINH']);
    $sheet->setCellValue("G".$dong,$ds[$i]['NOISINH']);
    $sheet->setCellValue("H".$dong,$ds[$i]['DIEMLT']);
    $sheet->setCellValue("J".$dong,$ds[$i]['DIEMTH']);
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
$objPHPExcel->getActiveSheet()->getStyle('H9:L'.($dong-1))->getNumberFormat() ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$objPHPExcel->getActiveSheet()->getStyle('H9:L'.($dong-1))->getNumberFormat() ->setFormatCode('#,##0.0'); // kết quả dạng 36,774.2
$sheet->getStyle('A7:B'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A7:B'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('E7:L'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('E7:L'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('H9:M'.($dong-1))->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A7:M'.($dong+5))->getFont()->setSize(12);

// Phần tổng kết
$objPHPExcel->getActiveSheet()->getRowDimension($dong)->setRowHeight(20);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A'.$dong.':M'.$dong);
$sheet->setCellValue("A".$dong,"Danh sách có ".($dong-9)." thí sinh.");
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getFont()->setItalic(true);
$sheet->getStyle('A'.$dong.':M'.($dong+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

// Phần ngày tháng năm
$dong++;
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('H'.$dong.':M'.$dong);
$objPHPExcel->getActiveSheet()->getStyle('H'.$dong.':M'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$sheet->setCellValue("H".$dong,"Vĩnh Long, ngày ".date('d')." tháng ".date('m')." năm ".date('Y'));
$objPHPExcel->getActiveSheet()->getStyle('H'.$dong)->getFont()->setItalic(true);

// Phần ký tên
$dong++;
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B'.$dong.':C'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E'.$dong.':G'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('H'.$dong.':M'.$dong);
$sheet->setCellValue("B".$dong,"CHỦ TỊCH HỘI ĐỒNG THI");
$sheet->setCellValue("E".$dong,"TRƯỞNG BAN CHẤM PHÚC KHẢO");
$sheet->setCellValue("H".$dong,"NGƯỜI LẬP DANH SÁCH");
$sheet->getStyle('B'.$dong.':H'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B'.$dong.':H'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B'.$dong.':K'.$dong)->getFont()->setBold(true);
$dong++;
// ký và ghi họ tên
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B'.$dong.':C'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E'.$dong.':G'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('H'.$dong.':M'.$dong);
$sheet->setCellValue("B".$dong,"(Ký và ghi rõ họ tên)");
$sheet->setCellValue("E".$dong,"(Ký và ghi rõ họ tên)");
$sheet->setCellValue("H".$dong,"(Ký và ghi rõ họ tên)");
$objPHPExcel->getActiveSheet()->getStyle('B'.$dong.':K'.$dong)->getFont()->setItalic(true);
$sheet->getStyle('B'.$dong.':H'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B'.$dong.':H'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getRowDimension($dong-2)->setRowHeight(25);

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