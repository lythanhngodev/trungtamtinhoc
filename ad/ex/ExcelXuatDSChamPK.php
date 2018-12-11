<?php
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
$tenfile = "BM-IC-24-00 - DSPK ".date('d-m-Y');
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
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C1:H4');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('I1:J1');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('I2:J2');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('I3:J3');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('I4:J4');

$objPHPExcel->getActiveSheet()->getStyle("I1:J4")->getFont()->setSize(13);
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);

$sheet->setCellValue("C1","DANH SÁCH THI SINH ĐĂNG KÝ CHẤM PHÚC KHẢO");
$sheet->setCellValue("I1","Mã số: BM-IC-24-00");
$sheet->setCellValue("I2","Ngày hiệu lực: 04/7/2018");
$sheet->setCellValue("I3","Lần soát xét: 00");
$sheet->setCellValue("I4","Trang:1/...");

$sheet->getStyle('A1:H4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:H4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle("C1")->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle("C1:H4")->getFont()->setBold(true);
$sheet->getStyle('A1:J4')
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A5:J5');
$sheet->setCellValue("A5","KỲ THI CẤP CHỨNG CHỈ ỨNG DỤNG CÔNG NGHỆ THÔNG TIN CƠ BẢN");
$objPHPExcel->getActiveSheet()->getStyle("A5")->getFont()->setSize(18);
$objPHPExcel->getActiveSheet()->getStyle("A5")->getFont()->setBold(true);
$sheet->getStyle('A5:J5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A5:J5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$sheet->getStyle('I1:J4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A6:J6');
$sheet->setCellValue("A6","Khóa ... , ngày ...");
$objPHPExcel->getActiveSheet()->getStyle("A6")->getFont()->setSize(14);
$sheet->getStyle('A6:J6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A6:J6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

// Phần thi lý thuyết
$sheet->setCellValue("A7","1. PHẦN THI LÝ THUYẾT");
$objPHPExcel->getActiveSheet()->getStyle("A7")->getFont()->setSize(13);
$objPHPExcel->getActiveSheet()->getStyle("A7")->getFont()->setBold(true);
$sheet->getStyle('A7:J7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(25);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A8:A9');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('B8:B9');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C8:C9');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('D8:E9');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('F8:F9');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('G8:G9');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('H8:H9');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('I8:I9');
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('J8:J9');

$sheet->setCellValue("A8","STT");
$sheet->setCellValue("B8","SBD");
$sheet->setCellValue("C8","Số CMND");
$sheet->setCellValue("D8","Họ tên");
$sheet->setCellValue("F8","Ngày sinh");
$sheet->setCellValue("G8","Giới\ntính");
$sheet->setCellValue("H8","Nơi sinh");
$sheet->setCellValue("I8","Điểm trước\nphúc khảo");
$sheet->setCellValue("J8","Mã số biên lai");

$objPHPExcel->getActiveSheet()->getStyle('A8:J9')->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle("A8:J9")->getFont()->setBold(true);

$sheet->getStyle('A8:J9')
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));
$objPHPExcel->getActiveSheet()->getStyle('A8:J9')->getFill()->applyFromArray(array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'b9b9b9'
    )
));
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

$diemkhoa = $kn->query("
SELECT DISTINCT dh.SBD,CONCAT(hv.HO,' ',hv.TEN) AS HOTEN, hv.CMND,hv.NGAYSINH,hv.GIOITINH, hv.NOISINH,pk.TENPK,dh.DIEMLT,dk.SOBIENLAIPK
FROM danhsachphuckhao_hocvien dk
    LEFT JOIN danhsachphuckhao pk ON dk.IDPK=pk.IDPK
    LEFT JOIN danhsachdangkyduthi_hocvien dh ON dh.IDDKTHV=dk.IDDKTHV
    LEFT JOIN danhsachdangkyduthi ds ON ds.IDDS=dh.IDDS
    LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dk.IDPK='$danhsach' AND dk.THILT=b'1' ORDER BY dh.SBD ASC;");
$ds = null;
while ($row = mysqli_fetch_assoc($diemkhoa)){
    $ds[] = $row;
}
$dong = 10;
$sokhongdat=0;
$sodat=0;
for ($i=0; $i < count($ds); $i++) { 
    $sheet->setCellValue("A".$dong,$i+1);
    $sheet->setCellValue("B".$dong,$ds[$i]['SBD']);
    $sheet->setCellValue("C".$dong,$ds[$i]['CMND']);
    $sheet->setCellValue("D".$dong,$ds[$i]['HOTEN']);
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('D'.$dong.':E'.$dong);
    $sheet->setCellValue("F".$dong,$ds[$i]['NGAYSINH']);
    $sheet->setCellValue("G".$dong,$ds[$i]['GIOITINH']);
    $sheet->setCellValue("H".$dong,$ds[$i]['NOISINH']);
    $sheet->setCellValue("I".$dong,$ds[$i]['DIEMLT']);
    $sheet->setCellValue("J".$dong,$ds[$i]['SOBIENLAIPK']);
    $dong++;
}
$sheet->getStyle('A9:J'.($dong-1))
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));
$objPHPExcel->getActiveSheet()->getStyle('I9:I'.($dong-1))->getNumberFormat() ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$objPHPExcel->getActiveSheet()->getStyle('I9:I'.($dong-1))->getNumberFormat() ->setFormatCode('#,##0.0'); // kết quả dạng 36,774.2

$sheet->getStyle('A8:C'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A8:C'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('E8:L'.($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('E8:L'.($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('C8:E9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('C8:E9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('I10:I'.($dong-1))->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A10:J'.($dong+5))->getFont()->setSize(12);

// Phần đếm số lượng chấm PK lý thuyết
$objPHPExcel->getActiveSheet()->getRowDimension($dong)->setRowHeight(20);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A'.$dong.':J'.$dong);
$sheet->setCellValue("A".$dong,"Danh sách có ".($dong-10)." thí sinh.");
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getFont()->setItalic(true);
$sheet->getStyle('A'.$dong.':J'.($dong+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* PHẦN ĐĂNG KÝ THI THỰC HÀNH */
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
++$dong;
$sheet->setCellValue("A$dong","2. PHẦN THI THỰC HÀNH");
$objPHPExcel->getActiveSheet()->getStyle("A$dong")->getFont()->setSize(13);
$objPHPExcel->getActiveSheet()->getStyle("A$dong")->getFont()->setBold(true);
$sheet->getStyle("A$dong:J$dong")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(25);
++$dong;
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("A$dong:A".($dong+1));
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("B$dong:B".($dong+1));
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("C$dong:C".($dong+1));
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("D$dong:E".($dong+1));
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("F$dong:F".($dong+1));
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("G$dong:G".($dong+1));
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("H$dong:H".($dong+1));
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("I$dong:I".($dong+1));
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells("J$dong:J".($dong+1));

$sheet->setCellValue("A$dong","STT");
$sheet->setCellValue("B$dong","SBD");
$sheet->setCellValue("C$dong","Số CMND");
$sheet->setCellValue("D$dong","Họ tên");
$sheet->setCellValue("F$dong","Ngày sinh");
$sheet->setCellValue("G$dong","Giới\ntính");
$sheet->setCellValue("H$dong","Nơi sinh");
$sheet->setCellValue("I$dong","Điểm trước\nphúc khảo");
$sheet->setCellValue("J$dong","Mã số biên lai");

$objPHPExcel->getActiveSheet()->getStyle("A$dong:J".($dong+1))->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->getStyle("A$dong:J".($dong+1))->getFont()->setBold(true);

$sheet->getStyle("A$dong:J".($dong+1))
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));
$objPHPExcel->getActiveSheet()->getStyle("A$dong:J".($dong+1))->getFill()->applyFromArray(array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'startcolor' => array(
        'rgb' => 'b9b9b9'
    )
));
$sheet->getStyle("A$dong:J".($dong+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("A$dong:J".($dong+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

++$dong;++$dong;

$diemkhoa = $kn->query("
SELECT DISTINCT dh.SBD,CONCAT(hv.HO,' ',hv.TEN) AS HOTEN, hv.CMND,hv.NGAYSINH,hv.GIOITINH, hv.NOISINH,pk.TENPK,dh.DIEMTH,dk.SOBIENLAIPK
FROM danhsachphuckhao_hocvien dk
    LEFT JOIN danhsachphuckhao pk ON dk.IDPK=pk.IDPK
    LEFT JOIN danhsachdangkyduthi_hocvien dh ON dh.IDDKTHV=dk.IDDKTHV
    LEFT JOIN danhsachdangkyduthi ds ON ds.IDDS=dh.IDDS
    LEFT JOIN hocvien hv ON dh.IDHV=hv.IDHV WHERE dk.IDPK='$danhsach' AND dk.THITH=b'1' ORDER BY dh.SBD ASC;");
$ds = null;
while ($row = mysqli_fetch_assoc($diemkhoa)){
    $ds[] = $row;
}
for ($i=0; $i < count($ds); $i++) { 
    $sheet->setCellValue("A".$dong,$i+1);
    $sheet->setCellValue("B".$dong,$ds[$i]['SBD']);
    $sheet->setCellValue("C".$dong,$ds[$i]['CMND']);
    $sheet->setCellValue("D".$dong,$ds[$i]['HOTEN']);
    $objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('D'.$dong.':E'.$dong);
    $sheet->setCellValue("F".$dong,$ds[$i]['NGAYSINH']);
    $sheet->setCellValue("G".$dong,$ds[$i]['GIOITINH']);
    $sheet->setCellValue("H".$dong,$ds[$i]['NOISINH']);
    $sheet->setCellValue("I".$dong,$ds[$i]['DIEMTH']);
    $sheet->setCellValue("J".$dong,$ds[$i]['SOBIENLAIPK']);
    $dong++;
}
$sheet->getStyle("A".($dong-count($ds)-1).":J".($dong-1))
    ->applyFromArray(array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    ));
$objPHPExcel->getActiveSheet()->getStyle("I".($dong-count($ds)-1).":I".($dong-1))->getNumberFormat() ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$objPHPExcel->getActiveSheet()->getStyle("I".($dong-count($ds)-1).":I".($dong-1))->getNumberFormat() ->setFormatCode('#,##0.0'); // kết quả dạng 36,774.2
$sheet->getStyle("A".($dong-count($ds)-1).":C".($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("A".($dong-count($ds)-1).":C".($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle("E".($dong-count($ds)-1).":J".($dong-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("E".($dong-count($ds)-1).":J".($dong-1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle("I".($dong-count($ds)-1).":I".($dong-1))->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A".($dong-count($ds)-1).":J".($dong-1))->getFont()->setSize(12);

// Phần đếm số lượng chấm PK thực hành
$objPHPExcel->getActiveSheet()->getRowDimension($dong)->setRowHeight(20);

$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('A'.$dong.':J'.$dong);
$sheet->setCellValue("A".$dong,"Danh sách có ".count($ds)." thí sinh.");
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A'.$dong)->getFont()->setItalic(true);
$sheet->getStyle('A'.$dong.':J'.($dong+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
// Phần ngày tháng năm
$dong++;
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('H'.$dong.':J'.$dong);
$objPHPExcel->getActiveSheet()->getStyle('H'.$dong.':J'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$sheet->setCellValue("H".$dong,"Vĩnh Long, ngày ".date('d')." tháng ".date('m')." năm ".date('Y'));
$objPHPExcel->getActiveSheet()->getStyle('H'.$dong)->getFont()->setItalic(true);

// Phần ký tên
$dong++;
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C'.$dong.':D'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('I'.$dong.':J'.$dong);
$sheet->setCellValue("C".$dong,"CHỦ TỊCH HỘI ĐỒNG THI");
$sheet->setCellValue("I".$dong,"NGƯỜI LẬP DANH SÁCH");
$sheet->getStyle('C'.$dong.':D'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('I'.$dong.':J'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C'.$dong.':I'.$dong)->getFont()->setBold(true);
$dong++;
// ký và ghi họ tên
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('C'.$dong.':D'.$dong);
$objPHPExcel->setActiveSheetIndex($numberSheet)->mergeCells('I'.$dong.':J'.$dong);
$sheet->setCellValue("C".$dong,"(Ký và ghi rõ họ tên)");
$sheet->setCellValue("I".$dong,"(Ký và ghi rõ họ tên)");
$objPHPExcel->getActiveSheet()->getStyle('C'.$dong.':I'.$dong)->getFont()->setItalic(true);
$sheet->getStyle('C'.$dong.':I'.$dong)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('C'.$dong.':I'.$dong)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
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