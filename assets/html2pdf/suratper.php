<?php
session_start();
ob_start();
include_once("../config.php"); //buat koneksi ke database
$id_permintaan   = $_GET['id_permintaan']; //kode berita yang akan dikonvert
$query  = mysql_query("SELECT * FROM permintaan 
    INNER JOIN unit_kerja 
        ON (permintaan.id_unitkerja = unit_kerja.id_unitkerja) WHERE id_permintaan='".$id_permintaan."'");
$data   = mysql_fetch_array($query);

?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $data['kode_permintaan']; ?></title>
<style type="text/css">
  table{margin: 0 auto;border-collapse: collapse;}
</style>
</head>
<body>
<?php
echo '<table >
      <tr>
        <td style="width:32%" rowspan="4"><img src=../logo/bidar.jpg width=150></td>
        <td></td>
      </tr>
      <tr>
        <td><p align=center><h3>UNIVERSITAS BINA DARMA PALEMBANG</h3>Jalan jenderal Ahmad Yani No. 12 Palembang 30264<br> Phone (0711) 515679 fax.(0711) 515583<br>  website : www.binadarma.ac.id email: bidar@binadarma.ac.id<br> bagian pengadaan dan infrastruktur</p>
        </td>
      </tr>
    </table>';
echo "<hr>";
echo "<h2><p align=center>SURAT PERMINTAAN BARANG</p></h2>";
echo "<p align='right'>Palembang, ".date('d-m-Y')."</p>";
echo '<table width=100px>
      <tr>
        <td>Kode Permintaan </td>
        <td>:</td>
        <td>'.$data['kode_permintaan'].'</td>
      </tr>
      <tr>
        <td>Lampiran</td>
        <td>:</td>
        <td>-</td>
      </tr>
      <tr>
        <td>Perihal</td>
        <td>:</td>
        <td>Pengajuan Permintaan Barang </td>
      </tr>
      </table>
      <br>';
echo "kode permintaan : <h1>".$data['kode_permintaan']."</h1>"; 
echo "<br>";
echo "<br>";
echo "<p>data yang tertera di bawah ini adalah data permintaan Barang yang diajukan oleh ".$data['nama_uk'].", data ini sebagai surat Permintaan Barang. data ini sudah disetujui oleh bagian terkait. berikut detail data Permintaan Barang :</p>";
echo '<table >
  <tr>
    <td width="200">Tanggal Peminjaman</td>
    <td width="10">:</td>
    <td width="250">'.$data['tgl_per'].'</td>
  </tr>
  <tr>
    <td>Nama </td>
    <td>:</td>
    <td>'.$data['nama_uk'].'</td>
  </tr>
  <tr>
    <td>Kategori</td>
    <td>:</td>
    <td>'.$data['kategori'].'</td>
  </tr>
  <tr>
    <td>kebutuhan</td>
    <td>:</td>
    <td>'.$data['kebutuhan'].'</td>
  </tr>
</table>';

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<p align='right'>Mengetahui, <br>Kabag Pengadaan dan Infrastruktur<br><img src='putih.jpg' width='120'><br>Ilman Zuhri Yadi,M.M.,M.Kom.</p>";
?>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="per-".$id_pinjam.".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
 require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
 try
 {
  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output($filename);
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>