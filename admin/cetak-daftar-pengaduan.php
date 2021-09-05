<?php
include('../koneksi.php');
require_once("../vendor/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$query = mysqli_query($koneksi,"select * from tbl_pengaduan JOIN tbl_tanggapan USING (id_pengaduan) JOIN tbl_masyarakat USING (id_masyarakat)");
$html = '<center><h1><b>PUSKESMAS ABCD</b></h1></center><br><br/>';
$html = '<center><h2><b>Daftar Bukti Pengaduan</b></h2></center><hr/><br/>';
$html .= '<table border="1" width="100%">
 <tr align="center">
 <th>No</th>
 <th>Judul Pengaduan</th>
 <th>Tanggal Pengaduan</th>
 <th>Pengirim</th>
 <th>Tanggal Balas</th>
 </tr>';
$no = 1;
while($row = mysqli_fetch_array($query))
{
 $html .= "<tr align='center'>
 <td>".$no."</td>
 <td>".$row['subjek_pengaduan']."</td>
 <td>".tgl_indo($row['tgl_pengaduan'])."</td>
 <td>".$row['nama']."</td>
 <td>".tgl_indo($row['tgl_balas_tanggapan'])."</td>
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
$dompdf->stream('laporan_daftar_pengaduan.pdf');
?>