<?php
include('koneksi.php');
$id = $_GET['id'];
session_start();
$nama = $_SESSION['nama'];
require_once("vendor/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$query = mysqli_query($koneksi,"select * from tbl_tanggapan JOIN tbl_petugas USING (id_petugas) where id_tanggapan='$id'");
$html = '<center><h2><b>Bukti Tanggapan</b></h2></center><br/>';
$row = mysqli_fetch_array($query);

$html .= '<table border="0" cellpadding="8" width="100%">
 <tr align="left">
    <td>ID Tanggapan</td>
    <td>:</td>
    <td>'.$row["id_tanggapan"].'</td>
 </tr>
 <tr align="left">
    <td>Petugas</td>
    <td>:</td>
    <td>'.$row["nama"].'</td>
</tr>
 <tr align="left">
    <td>Tanggal Balas</td>
    <td>:</td>
    <td>'.tgl_indo($row['tgl_balas_tanggapan']).'</td>
 </tr>
 <tr align="left">
    <td>Status</td>
    <td>:</td>
    <td>'.$row["status_tanggapan"].'</td>
 </tr>
 <tr align="left">
    <td>Isi Tanggapan</td>
    <td>:</td>
    <td>'.$row["isi_tanggapan"].'</td>
 </tr>';

$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_tanggapan.pdf');
?>