<?php  


require_once __DIR__."\..\libraries\PHPExcel-1.8\Classes\PHPExcel.php";  
echo "<P>test phpexcel</P>";  
  
//读数据  
$filename = 'E:\\van\\excel\\xyvip1.xls';  
//$objReader = PHPExcel_IOFactory::createReaderForFile($filename);; //准备打开文件  
//$objPHPExcel = $objReader->load($filename);   //载入文件  
//$objPHPExcel->setActiveSheetIndex(0);         //设置第一个Sheet  
//$data = $objPHPExcel->getActiveSheet()->getCell('A2')->getValue();  //获取单元格A2的值  
//echo $data; 

$reader = PHPExcel_IOFactory::createReader('Excel5'); //设置以Excel5格式(Excel97-2003工作簿)  
$PHPExcel = $reader->load("$filename"); // 载入excel文件  
$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表  
$highestRow = $sheet->getHighestRow(); // 取得总行数  
$highestColumm = $sheet->getHighestColumn(); // 取得总列数  
  
$dataset = [];
/** 循环读取每个单元格的数据 */  
for ($row = 1; $row <= $highestRow; $row++)    //行号从1开始  
{  
    for ($column = 'A'; $column <= $highestColumm; $column++)  //列数是以A列开始  
    {  
        $dataset[] = $sheet->getCell($column.$row)->getValue();  
        echo $column.$row.":".$sheet->getCell($column.$row)->getValue()."<br\>";  
    }  
}  
$str = '(';
foreach ($dataset as $val){
    $str .= $val.",";
}
dump($str);
dump($dataset);die;
  
//写数据  
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Hello');//指定要写的单元格位置   
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
$objWriter->save('2.xls');  
  

	


            