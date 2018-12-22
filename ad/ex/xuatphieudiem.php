<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['_checkpage'])) {echo "<h2>Đâu dễ phá vậy</2>";die();}
if(!isset($_GET['idl']) || empty($_GET['idl'])){
    echo "Không có dữ liệu";
    exit();
}
require_once '../../__.php';
include_once "../ec/PHPExcel.php";
$kn = new clsKetnoi();
$danhsach = intval($_GET['idl']);
$objPHPExcel = new PHPExcel;
$numberSheet = 0;
$objPHPExcel->setActiveSheetIndex($numberSheet);
$tenfile = "BM-IC-33-00 - PDQT ".date('d-m-Y');
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
$objDrawing->setOffsetX(40);
$objDrawing->setOffsetY(8);
$styleArray = array(
    'font'  => array(
        'name'  => 'Times New Roman',
        'size' => 12
    ));
$objPHPExcel->getActiveSheet()
    ->getStyle( $objPHPExcel->getActiveSheet()->calculateWorksheetDimension() )
    ->applyFromArray($styleArray);  
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C1:E4');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F1:G1');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F2:G2');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F3:G3');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F4:G4');

$objPHPExcel->getActiveSheet()->getStyle("F1:G4")->getFont()->setSize(13);
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('5')->setRowHeight(80);

$sheet->setCellValue("C1","PHIẾU ĐIỂM QUÁ TRÌNH");
$sheet->setCellValue("F1","Mã số: BM-IC-33-00");
$sheet->setCellValue("F2","Ngày hiệu lực: 04/7/2018");
$sheet->setCellValue("F3","Lần soát xét: 00");

$sheet->getStyle('A1:C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('F1:G4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle("C1:E4")->getFont()->setBold(true);
$sheet->getStyle('A1:G4')
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A5:G5');
$str = $kn->query("
SELECT DISTINCT kh.TENKHOA, kh.TGBATDAU,kh.TGKETTHUC,l.MALOP,pc.TENCB,pc.DIADIEM
FROM
    lop l
    LEFT JOIN khoahoc_lop khl ON khl.IDL = l.IDL
    LEFT JOIN khoahoc kh ON khl.IDKH = kh.IDKH
    LEFT JOIN phanconggiangday pc ON pc.MALOP = l.MALOP
WHERE
    l.IDL = '$danhsach';
");
$objPHPExcel->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);
$tt = mysqli_fetch_assoc($str);
$sheet->setCellValue("A5","
DANH SÁCH HỌC VIÊN LỚP KỸ NĂNG SỬ DỤNG CNTT CƠ BẢN\n  Khoá ".$tt['TENKHOA'].", từ ngày ".$tt['TGBATDAU']." đến ngày ".$tt['TGKETTHUC']."\nMã lớp: ".$tt['MALOP'].", CBGD: ".$tt['TENCB'].", Phòng ".$tt['DIADIEM']."                    
");

$objPHPExcel->getActiveSheet()->getStyle('A5:G5')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle("A5")->getFont()->setSize(14);
$sheet->getStyle('A5:G7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A5:G7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A6:A7');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B6:C7');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('D6:D7');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E6:F6');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('G6:G7');

$sheet->setCellValue("A6","TT");
$sheet->setCellValue("B6","Họ và tên");
$sheet->setCellValue("D6","Ngày sinh");
$sheet->setCellValue("E6","ĐIỂM");
$sheet->setCellValue("E7","Lý thuyết");
$sheet->setCellValue("F7","Thực hành");
$sheet->setCellValue("G6","Ghi chú");

$sheet->getStyle('A6:G7')
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));
$objPHPExcel->getActiveSheet()->getStyle('A6:G7')->getFill()->applyFromArray(array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'b9b9b9'
    )
));
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);

$diemkhoa = $kn->query("
SELECT hv.HO,hv.TEN,hv.NGAYSINH,hv.GIOITINH,hv.NOISINH,hv.GHICHU FROM hocvien_lop hvl LEFT JOIN hocvien hv On hvl.IDHV = hv.IDHV WHERE hvl.IDL = '$danhsach';
");

$ds = null;
while ($row = mysqli_fetch_assoc($diemkhoa)){
    $ds[] = $row;
}
$dong = 8;
for ($i=0; $i < count($ds); $i++) { 
    $ngaythang = $ds[$i]['NGAYSINH'];
    $sheet->setCellValue("A".$dong,$i+1);
    $sheet->setCellValue("B".$dong,$ds[$i]['HO']);
    $sheet->setCellValue("C".$dong,$ds[$i]['TEN']);
    $sheet->setCellValue("D".$dong,$ds[$i]['NGAYSINH']);
    $dong++;
}
$sheet->getStyle('A8:G'.($dong-1))
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));

$objPHPExcel->getActiveSheet()->getStyle('E8:F'.($dong-1))->getNumberFormat() ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$objPHPExcel->getActiveSheet()->getStyle('E8:F'.($dong-1))->getNumberFormat() ->setFormatCode('#,##0.0'); // kết quả dạng 36,774.2
$sheet->getStyle('A8:A'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A8:A'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('D8:F'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('D8:F'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A8:G'.($dong+5))->getFont()->setSize(12);

// Phần ngày tháng năm
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E'.$dong.':G'.$dong);
$sheet->setCellValue("E".$dong,"Vĩnh Long, ngày ...... tháng ...... năm ".date('Y'));
$objPHPExcel->getActiveSheet()->getStyle('E'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('E'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('E'.$dong)->getFont()->setItalic(true);
// Phần ký tên
$dong+=2;
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B'.$dong.':D'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E'.$dong.':G'.$dong);

$sheet->setCellValue("B".$dong,"Cán bộ giảng dạy");
$sheet->setCellValue("E".$dong,"Lập bảng");

$sheet->getStyle('A'.$dong.':G'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A'.$dong.':G'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B'.$dong.':G'.$dong)->getFont()->setBold(true);
$dong++;
// ký và ghi họ tên
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B'.$dong.':D'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('E'.$dong.':G'.$dong);

$sheet->setCellValue("B".$dong,"(Ký và ghi rõ họ tên)");
$sheet->setCellValue("E".$dong,"(Ký và ghi rõ họ tên)");

$objPHPExcel->getActiveSheet()->getStyle('B'.$dong.':K'.$dong)->getFont()->setItalic(true);
$sheet->getStyle('B'.$dong.':G'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('B'.$dong.':G'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
// Save Excel 2007 file
#echo date('H:i:s') . " Write to Excel2007 format\n";

$objWriter = New PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save("$tenfile.xlsx");
// We'll be outputting an excel file
header("Content-Disposition: attachment; filename='$tenfile.xlsx'");
header('Content-type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
header('Content-Length: '.'$tenfile.xlsx');
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: no-cache');
readfile("$tenfile.xlsx");
return;
?>