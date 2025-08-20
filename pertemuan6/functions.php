<?php


$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'latihanphp'
);


function getData($query) {
    global $conn;
    $data = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($data);
}




function hapus() {
    global $conn;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        mysqli_query($conn, "DELETE FROM upload WHERE id=$id");
        return mysqli_affected_rows($conn);
    }
} //mengembalikan nilai tipe INT






function upload() {
    global $conn;
    if (isset($_POST['submit'])) {
        $namaGambar = $_FILES['gambar']['name']; //mengambil nama gambar dari array variabel $_FILES
        $path = $_FILES['gambar']['tmp_name']; //mengambil tempat penyimpanan sementara dari array variabel $_FILES
        // $allowEktensi = ['png', 'jpg', 'jpeg'];
        // $ektensi = explode('.', $namaGambar);
        move_uploaded_file($path, 'img/' . $namaGambar); // memindahkan dari penyimpanan sementara ke direktori yang ditentukan
        $gambar = $namaGambar;
        $nama = $_POST['nama'];
        $query = "INSERT INTO upload VALUES ('', '$nama', '$gambar')";
        $sql = mysqli_query($conn, $query);
        return $sql;
    }
}






function rulesUpload() {
    if (isset($_POST['submit'])) {
        $namaGambar = $_FILES['gambar']['name'];
        $break = explode('.', $namaGambar);
        $ekstensi = strtolower(end($break));
        $allowEkstensi = ['png', 'jpg', 'jpeg'];
        $pesanError = '';
        
        

        // cek apakah sudah upload gambar
        if ($_FILES['gambar']['error'] === 4) {
            return $pesanError = 1; //belom mengupload gambar
        } else {
            if (in_array($ekstensi, $allowEkstensi)) {
                upload();
                return $pesanError = 0; //ekstensi sesuai dengan yang ditentukan
            } else {
                return $pesanError = 1; //dilarang mengupload file
                
            }
        }
    }

}











?>