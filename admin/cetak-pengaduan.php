<?php
include('../koneksi.php');
require_once("../vendor/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$query = mysqli_query($koneksi,"select * from tbl_pengaduan JOIN tbl_tanggapan USING (id_pengaduan) JOIN tbl_masyarakat USING (id_masyarakat)");
$html = '<center><h1><b>PUSKESMAS ABCD</b></h1></center><br><br/>';
$html = '<center><h2><b>Bukti Pengaduan</b></h2></center><hr/><br/>';

$row = mysqli_fetch_array($query);

$html .= "<table border='0' width='100%'>
            <tr align='left'>
                <td>Pengirim</td>
                <td>".$row['nama']."</td>
            </tr>
            <tr align='left'>
                <td>Tanggal Pengaduan</td>
                <td>".tgl_indo($row['tgl_pengaduan'])."</td>
            </tr>
            <tr align='left'>
                <td>Subjek Pengaduan</td>
                <td>".$row['subjek_pengaduan']."</td>
            </tr>
            <tr align='left'>
                <td>Isi Pengaduan</td>
                <td>".$row['isi_pengaduan']."</td>
            </tr>
            <tr align='left'>
                <td>Bukti Foto</td>
                <td><img src='../buktifoto/".$row['bukti_pengaduan']."' width='130px' height='100px'/></td>
            </tr>
            <tr align='left'>
                 <td colspan='2'><b>Balasan</b></td>
            </tr>
            <tr align='left'>
                <td>ID Petugas</td>
                <td>".$row['id_petugas']."</td>
             </tr>
            <tr align='left'>
                 <td>Tanggal Balas</td>
                 <td>".tgl_indo($row['tgl_balas_tanggapan'])."</td>
            </tr>
            <tr align='left'>
                <td>Status</td>
                <td>".$row['status_tanggapan']."</td>
            </tr>
            <tr align='left'>
                <td>Isi Tanggapan</td>
                <td>".$row['isi_tanggapan']."</td>
            </tr>

 
 ";


$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_pengaduan.pdf');
?>