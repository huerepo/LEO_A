<?php
//HUEREPO THE GREEN MAN IN TENOCHTITLAN. 2017. 4 Yhüri MY SOON. AT JULIA.BEBOP@GMAIL.COM
	require 'fpdf.php'; 
	require 'con.php';

	$curso = $_GET['curso'];
	$p = $_GET['p'];
	$dietther = '40';
	$jhenkzin = '404';
	$prophet = $_GET['o'];

	$posgrado = "select mdl_course.fullname from mdl_course where mdl_course.id = 1";
	$resultado1 = $mysqli->query($posgrado);
	while($row = $resultado1->fetch_assoc())
	{
	$posgrado_nombre = $row['fullname'];
	}
		 
	$periodo2 = "select mdl_course.summary from mdl_course where mdl_course.id = $curso";
	$resultado2 = $mysqli->query($periodo2);
	while($row = $resultado2->fetch_assoc())
	{
	$periodo_completo = trim($row['summary'], "<p></");
	}
	
	$materia = "select curso.fullname from mdl_course as curso where curso.id = $curso";
	$resultado3 = $mysqli->query($materia);
	while($row = $resultado3->fetch_assoc())
	{
	$asignatura_nombre = $row['fullname'];
	}

	$docente = "select mdl_user_info_data.data, mdl_user.firstname, mdl_user.lastname from mdl_user_info_data, mdl_user where mdl_user.id = $p and mdl_user_info_data.userid = $p";
	$resultado4 = $mysqli->query($docente);
	while($row = $resultado4->fetch_assoc())
	{
	$docente_grado = $row['firstname'];
	$docente_nombre = $row['lastname'];
	$docente_matricula = $row['data'];
	}
	
	$jefe = "select infox.data, mdl_user.firstname, mdl_user.lastname from mdl_user_info_data as infox, mdl_user where mdl_user.id = $jhenkzin and infox.userid = $jhenkzin";
	$resultado5 = $mysqli->query($jefe);
	while($row = $resultado5->fetch_assoc())
	{
	$director_grado = $row['firstname'];
	$director_nombre = $row['lastname'];
	$director_matricula = $row['data'];
	}

	$prophe = "SELECT * FROM mdl_user where id = $prophet";
	$prophetq = $mysqli->query($prophe);
	while($row = $prophetq->fetch_assoc())
	{
	$prophetr = $row['firstname'].' '.$row['lastname'];
	}

	$nprinta = "select count(sl_course) as total from mdl_slink where sl_course = $curso";
        $nprintb = $mysqli->query($nprinta);
	while($row = $nprintb->fetch_assoc())
        {
        $nprint = $row['total'];
	}


	$director = "select infox.data, mdl_user.firstname, mdl_user.lastname from mdl_user_info_data as infox, mdl_user where mdl_user.id = $dietther and infox.userid = $dietther";
	$resultado6 = $mysqli->query($director);
	while($row = $resultado6->fetch_assoc())
	{
	$director_grado = $row['firstname'];
	$director_nombre = $row['lastname'];
	$director_matricula = $row['data'];
	}
	
	$calificaciones = "SELECT mu.id, c.fullname AS shortname, mu.firstname, mu.lastname, FORMAT(gg.finalgrade,2) AS finalgrade FROM mdl_grade_items AS gi INNER JOIN mdl_course c ON c.id = gi.courseid LEFT JOIN mdl_grade_grades AS gg ON gg.itemid = gi.id INNER JOIN mdl_user AS mu ON gg.userid = mu.id WHERE gi.itemtype = 'course' and c.id = $curso AND finalgrade >= 0 ORDER by mu.idnumber;";
	$resultado5 = $mysqli->query($calificaciones);
	class PDF extends FPDF
	{function Header(){}
	function Footer(){}
	}
	
	$numero = "1";
		 
	$pdf = new PDF('P','mm','Letter');
	$pdf->SetMargins(0, 0 , 0);
	$pdf->SetAutoPageBreak(true,1); 
	$pdf->AddPage();
	$titulo = utf8_decode('Acta de calificación');
	$pdf->SetTitle($titulo);
	$pdf->AddFont('monse', '', 'MontserratRegular.php');
	$pdf->AddFont('monseb', '', 'MontserratBold.php');

	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $hora = date("h:i: A"); 		 
	$LUGARFECHA =  $dias[date('d')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');

	$pdf->SetFont('monseb','',10);
	$pdf-> SetY(1);
    $pdf->Image('img/back001.jpg',0,0,216,280,'JPG');
	$pdf-> SetY(1);
    $pdf->SetX(40);
	$pdf->SetFont('monse','');
	$pdf->Multicell(140,4,utf8_decode("\n\nESCUELA NACIONAL ......\nDIRECCIÓN DE LA ESCUELA DE ARTE Y HUMANIDADES....\nSUBDIRECCIÓN DE POSGRADOS\n PROMOCIÓN II"),0,'C');
	$pdf->SetFont('monseb','');
	$pdf->SetY(28);
	$pdf->Multicell(0,4,utf8_decode("\nACTA DE CALIFICACIONES"),0,'C');
	$pdf->Ln(5);
	
	$pdf-> SetY(40); 
	$pdf-> SetX(20); 
	$pdf->SetFont('monse','',10);
	$pdf->Cell(40,0,utf8_decode("POSGRADO : "), 0, 0, 'L');
	$pdf->Line(55, 41.5, 180, 41.5);
			$pdf -> SetX(55); 
			$pdf->SetFont('monse','',10);
			$pdf->Cell(10,0,utf8_decode("Posgrado en Diseño .... "), 0, 0, 'L');
	$pdf-> SetY(45);
	$pdf-> SetX(20); 
	$pdf->SetFont('monse','',10);
	$pdf->Cell(40,0,utf8_decode("DOCENTE : "), 0, 0, 'L');
	$pdf->Line(55, 46.5, 180, 46.5);	
			$pdf -> SetX(55); 
	$pdf->SetFont('monse','',10);
			$pdf->Cell(10,0,$GLOBALS['docente_grado'].' '.utf8_decode($GLOBALS['docente_nombre']), 0, 0, 'L');

	$pdf -> SetY(50);
	$pdf-> SetX(20); 
	$pdf->SetFont('monse','',10);
	$pdf->Cell(40,0,utf8_decode("ASIGNATURA : "), 0, 0, 'L');
	$pdf->Line(55, 51.5, 180, 51.5);
			$pdf-> SetX(55); 
	$pdf->SetFont('monse','',10);
			$pdf->Cell(10,0,utf8_decode($GLOBALS['asignatura_nombre']), 0, 0, 'L');
	$pdf -> SetY(55);
	$pdf-> SetX(20); 
	$pdf->SetFont('monse','',10);
	$pdf->Cell(40,0,utf8_decode("PERIODO : "), 0, 0, 'L');	
	$pdf->Line(55, 56.5, 180, 56.5);
			$pdf-> SetX(55); 
	$pdf->SetFont('monse','',10);
			$pdf->Cell(10,0,$GLOBALS['periodo_completo'], 0, 0, 'L');
	$pdf -> SetY(60);
	$pdf-> SetX(20); 
	$pdf->SetFont('monse','',10);
	$pdf->Cell(40,0,utf8_decode("LUGAR Y FECHA : "), 0, 0, 'L');
	$pdf->Line(55, 61.5, 180, 61.5);	
			$pdf-> SetX(55); 
	$pdf->SetFont('monse','',10);
			$pdf->Cell(5,0,utf8_decode("Ciudad de México, a $LUGARFECHA"), 0, 0, 'L');

	$pdf->SetFont('monseb','',10);
	$pdf -> SetY(67);	
	$pdf-> SetX(13); 		
	$pdf->Cell(40,0,utf8_decode("N/P."),0,0,'L');	
	$pdf-> SetX(30); 	
	$pdf->Cell(40,0,utf8_decode("GRADO ACADÉMICO"),0,0,'L');	
	$pdf-> SetX(100); 
	$pdf->Cell(40,0,utf8_decode("NOMBRE"),0,0,'L');	
	$pdf-> SetX(171); 
	$pdf->Cell(40,0,utf8_decode("CALIFICACIÓN"),0,0,'L');	
	  
	$espacio = 70;


$promedio = 0 ;

 while($row = $resultado5->fetch_assoc()){
	$pdf->SetY($espacio);
		$pdf->SetX(10);
		$pdf->SetFont('monse','',10);
		$pdf->Cell(190,5,''."     ".$numero."",1,0,'L');

	 $pdf->SetY($espacio);
		$pdf->SetX(28);
		$pdf->Cell(160,5,''.$row['firstname'].'',0,0,'L'); 
	
	 $pdf->SetY($espacio);
		$pdf->SetX(88);
		$pdf->Cell(10,5,''.utf8_decode($row['lastname']).'',0,0,'L'); 
		$pdf->SetX(196);
		$pdf->Cell(-5,5,''.$row['finalgrade']."".'',0,0,'R');
	
	 $pdf->Line(25, $espacio+5, 25, $espacio);
	 $pdf->Line(85, $espacio+5, 85, $espacio);
	 $pdf->Line(172, $espacio+5, 172, $espacio);
	
	 $numero++;
	 $espacio  = $espacio + 5;
	 $promedio = $promedio + $row['finalgrade'];		
	}
	 
	$factor = $numero - 1;
	$promedio_final = $promedio / $factor;		

	$pdf->SetY($espacio);

 
$pdf->Image('img/universidad01.png',180,5,22,29,'PNG');
$pdf->Image('img/universidad02.png',15,5,27,27,'PNG');
$pdf->Image('img/footer.png',0,265,216,12,'PNG');

	$pdf->SetFont('monseb','',10);
	    $pdf->SetX(10);
	    $pdf->Cell(162,7,utf8_decode("PROMEDIO GRUPAL   "),-1,0,'L');
 	    $pdf->MultiCell(28,7,number_format($promedio_final ,2,".","."),1,'C');
		$pdf->SetX(40);


		$pdf->SetFont('monse','',10);
		$pdf->SetY(264);
		$pdf->SetX(20);
		$pdf->SetFont('ARIAL','',6);
		$pdf->Cell(135,0,utf8_decode("Nota:     La calificación mínima aprobatoria para los aspectos académicos será 60 en escala de 1 a 100."),0,0,'R');



$pdf->AddPage();
$pdf->Image('img/back001.jpg',0,0,216,280,'JPG');

                        $pdf->SetY(260);
                        $pdf->SetX(15);
                        $pdf->SetFont('monse','',10);
		$pdf->SetY(133);
		$pdf->SetX(25);
		$pdf->Multicell(70,4,utf8_decode("\n\nDirector(a)\nMaestría en Diseño...."),0,'C');

		$pdf->SetY(217);
		$pdf->SetX(57);
		$pdf->SetY(155);
		$pdf->SetX(25);
			$pdf->MultiCell(70,4,"___________________\n".$GLOBALS['director_grado']."\n".utf8_decode($GLOBALS['director_nombre'])."\n( ".$GLOBALS['director_matricula']." )",0,'C');
			$pdf->SetX(130);
                        $pdf->SetY(145);
                        $pdf->Multicell(190,4,utf8_decode("Docente de la asignatura           "),0,'R');
                        $pdf->SetY(155);
                        $pdf->SetX(122);
			$pdf->MultiCell(70,4,"___________________\n".$GLOBALS['docente_grado']."\n".utf8_decode($GLOBALS['docente_nombre'])."\n( ".$GLOBALS['docente_matricula']." )",0,'C');



                        $pdf->SetY(195);
                        $pdf->Multicell(0,3,utf8_decode("Vo.            Bo."),0,'C');
                        $pdf->MultiCell(215,4,"".utf8_decode($GLOBALS['director_grado']."\n").utf8_decode($GLOBALS['director_nombre'])."\n( ".$GLOBALS['director_matricula']." )",0,'C');

                        $pdf->SetY(180);
                        $pdf->SetX(45);
                        $pdf->SetFont('monse','',5);

                        $pdf->SetY(247);
                        $pdf->SetX(0);
                        $pdf->SetFont('monse','',10);
                        $pdf->Cell(17,10,utf8_decode(""),0,0,'R');

			$numerot = $numero - 1;

			$nprint = $nprint+1;


$cadenain = "╔█████████████████████████████████╗\n█╠ ESTE DOCUMENTO SE HA GENERADO UN TOTAL DE: ".$nprint." VECES.\n██████████████████████\n█╠ UNIVERSIDAD NACIONAL 2025. MAESTRÍA EN DISEÑO .... PROMOCIÓN III\n█╠ ASIGNATURA: ".$asignatura_nombre." \n█╠ Documento generado el ".$LUGARFECHA.", a las ".$hora.", por: ".$prophetr."\n█╠ Docente: ".$docente_grado." ".$docente_nombre."\n█╠ Cantidad de Discentes: ".$numerot."\n╚█████████████████████████████████╝\n";

$n = 1; 
$resultado5 = $mysqli->query($calificaciones);
        while($row = $resultado5->fetch_assoc())
        {
		$duno[] = $n.".-".$row['firstname']." ".$row['lastname'].' : '.$row['finalgrade']."=\n";
		$n++;
        }
$dauno = implode("",$duno);
$dfinal = base64_encode($cadenain.$dauno);

$pdf->Image('img/very.jpg',172,259,30,10,'JPG');


$pdf->SetY(230);
$pdf->SetX(2);
$pdf->SetTextColor(1,1,1);
$pdf->SetFont('ARIAL','',7);
//$pdf->MultiCell(80,2,$dfinal,0,1,);

$addlink = $mysqli->prepare("INSERT INTO mdl_slink (sl_course, sl_docente, sl_fecha, sl_hora, sl_prophet, sl_codex) VALUES (?,?,?,?,?,?)");
$addlink->bind_param("ssssss", $curso, $p, $LUGARFECHA, $hora, $prophetr, $dfinal);
$addlink->execute();





$urlo = "https://dominio.edu.mx/moodle/leo/ver.php?idc=".$curso;
$codigo = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);
//echo $codigo; 


$stmt = $db2->prepare("INSERT INTO links (codigo, url_larga) VALUES (?, ?)");
$stmt->bind_param("ss", $codigo, $urlo);
$stmt->execute();
//$stmt->close();



$pdf->SetY(270);
$pdf->SetX(167);
$pdf->MultiCell(180,3,"https://dominio.edu.mx/".$codigo,0,1,);




$pdf->Output();
?>
