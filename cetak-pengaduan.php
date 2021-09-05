<?php
include('koneksi.php');
$id = $_GET['id'];
session_start();
$nama = $_SESSION['nama'];
require_once("vendor/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$query = mysqli_query($koneksi,"select * from tbl_pengaduan where id_pengaduan='$id'");
$html = '<center><h2><b>Bukti Pengaduan</b></h2></center><br/>';
$row = mysqli_fetch_array($query);

$html .= '<table border="0" cellpadding="8" width="100%">
 <tr align="left">
    <td>ID Pengaduan</td>
    <td>:</td>
    <td>'.$row["id_pengaduan"].'</td>
 </tr>
 <tr align="left">
    <td>Tanggal Pengaduan</td>
    <td>:</td>
    <td>'.tgl_indo($row['tgl_pengaduan']).'</td>
 </tr>
 <tr align="left">
    <td>Nama</td>
    <td>:</td>
    <td>'.$nama.'</td>
 </tr>
 <tr align="left">
    <td>Subjek Pengaduan</td>
    <td>:</td>
    <td>'.$row["subjek_pengaduan"].'</td>
 </tr>
 <tr align="left">
    <td>Isi Pengaduan</td>
    <td>:</td>
    <td>'.$row["isi_pengaduan"].'</td>
 </tr>';

$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_pengaduan.pdf');
?>