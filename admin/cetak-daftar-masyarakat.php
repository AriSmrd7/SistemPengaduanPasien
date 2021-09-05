<?php
include('../koneksi.php');
require_once("../vendor/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$query = mysqli_query($koneksi,"select * from tbl_masyarakat");
$html = '<center><h1><b>PUSKESMAS ABCD</b></h1></center><br><br/>';
$html = '<center><h2><b>Daftar Masyarakat</b></h2></center><hr/><br/>';
$html .= '<table border="1" width="100%">
 <tr align="center">
 <th>No</th>
 <th>NIK</th>
 <th>Nama</th>
 <th>Email</th>
 </tr>';
$no = 1;
while($row = mysqli_fetch_array($query))
{
 $html .= "<tr align='center'>
 <td>".$no."</td>
 <td>".$row['nik']."</td>
 <td>".$row['nama']."</td>
 <td>".$row['email']."</td>
 </tr>";
 $no++;
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_daftar_masyarakat.pdf');
?>