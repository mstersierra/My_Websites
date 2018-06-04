<?php 
	//========ADMIN_PAGE=========//
	//FUNCTIONS ADMIN_PAGE & TABEL USER LOGIN & MATERI, TUGAS, PENGUMUMAN
	//Koneksi ke database (variable $conn)
$conn = mysqli_connect("localhost","root","","kursus_inggris");	//hostname, username, password, nama database

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)) :
		$rows[] = $row;
	endwhile;
	return $rows;
}

//====================== Users Management==========
function adduser($data){
	global $conn;

	$username = htmlspecialchars($data["username"]);
	$password = htmlspecialchars($data["password"]);
	$name = htmlspecialchars($data["name"]);
	$email = htmlspecialchars($data["email"]);
	$status = htmlspecialchars($data["status"]);

	// query insert data
	$query = "INSERT INTO login
				VALUES
				('$username','$password','$name','$email','$status')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function updateuser($data){
	global $conn;
	$oldusername = $data["oldusername"];
	$username = htmlspecialchars($data["username"]);
	$password = htmlspecialchars($data["password"]);
	$name = htmlspecialchars($data["name"]);
	$email = htmlspecialchars($data["email"]);
	$status = htmlspecialchars($data["status"]);

	// query update data
	$query = "UPDATE login
				SET
				username = '$username', password = '$password', name = '$name', email = '$email', status = '$status'
				WHERE username = '$oldusername'
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function deleteuser($username){
	global $conn;
	mysqli_query($conn, "DELETE FROM login WHERE username = '$username'");
	return mysqli_affected_rows($conn);
}

function search_users($keyword){
	$query = "SELECT * FROM login WHERE 
	username LIKE '%$keyword%' OR 
	name LIKE '%$keyword%' OR
	email LIKE '%$keyword%' OR  
	status LIKE '%$keyword%'
	";
	return query($query);
}
//=============== End of User Management================

//========================= Student Management============

function addstudent($data){
	global $conn;

	$username = htmlspecialchars($data["username"]);
	$studentname = htmlspecialchars($data["studentname"]);
	$class = htmlspecialchars($data["class"]);
	$email = htmlspecialchars($data["email"]);
	$address = htmlspecialchars($data["address"]);
	$phonenumber = htmlspecialchars($data["phonenumber"]);
	

	//Upload file photo
	$photo = uploadphoto();

	if(!$photo) :
		return false;
	endif;

	$namaFile = $_SESSION["photo_name"];
	// query insert data
	$query = "INSERT INTO murid
				VALUES
				('$username','$studentname','$class','$email','$address','$phonenumber','$photo','$namaFile')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function uploadphoto()
{
	$namaFile = $_FILES['photo']['name'];
	$ukuranFile = $_FILES['photo']['size'];
	$error = $_FILES['photo']['error'];
	$tmpName = $_FILES['photo']['tmp_name'];

	$_SESSION["photo_name"] = $namaFile;

	//Cek apakah tidak ada gambar yang diupload
	if($error === 4) : // error no 4 === tidak ada file yang diupload 
		echo "
			<script>
			 	alert('No photo selected');
			</script>
		";
		return false;
	endif;

	// cek apakah yang diupload adalah gambar
	$ekstensiFileValid = ['jpg', 'jpeg', 'png'];
	$ekstensiFile = explode('.', $namaFile); //explode = pecah string jadi array
	$ekstensiFile = strtolower(end($ekstensiFile)); //strtolower = force huruf besar jadi huruf kecil
	if(!in_array($ekstensiFile, $ekstensiFileValid)) :
		echo "
			<script>
			 	alert('Adding student failed, extension file is not image extension');
			</script>
		";
		return false;
	endif;

	//Cek jika ukurannya terlalu besar
	if($ukuranFile > 1000000) : //Maks = 1 MBytes
		echo "
			<script>
			 	alert('Adding student failed, file size more than 1 MB');
			</script>
		";
		return false;
	endif;

	//lolos pengecekan, file siap diupload
	//generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'student_photos/' . $namaFileBaru);
	return $namaFileBaru;

}

function updatestudent($data){
	global $conn;

	$oldusername = $data["oldusername"];
	$username = htmlspecialchars($data["username"]);
	$studentname = htmlspecialchars($data["studentname"]);
	$class = htmlspecialchars($data["class"]);
	$email = htmlspecialchars($data["email"]);
	$address = htmlspecialchars($data["address"]);
	$phonenumber = htmlspecialchars($data["phonenumber"]);
	$oldphoto = htmlspecialchars($data["oldphoto"]);
	$namaFile = htmlspecialchars($data["photo_name"]);

	//Cek apakah user pilih gambar baru atau tidak
	if($_FILES['photo']['error'] === 4) :
		$photo = $oldphoto;
	else :
		$photo = uploadphoto();
		$namaFile = $_SESSION["photo_name"];
	endif;

	// query update data
	$query = "UPDATE murid
				SET
				username = '$username', 
				nama_murid = '$studentname', 
				id_kelas = '$class', 
				email = '$email', 
				alamat = '$address', 
				notelp = '$phonenumber', 
				photo = '$photo', 
				namafile = '$namaFile'
				WHERE username = '$oldusername'";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function deletestudent($username){
	global $conn;
	mysqli_query($conn, "DELETE FROM murid WHERE username = '$username'");
	return mysqli_affected_rows($conn);
}

function search_student($keyword){
	$query = "SELECT * FROM murid WHERE 
	username LIKE '%$keyword%' OR 
	nama_murid LIKE '%$keyword%' OR
	id_kelas LIKE '%$keyword%' OR
	alamat LIKE '%$keyword%' OR
	notelp LIKE '%$keyword%' OR
	email LIKE '%$keyword%'
	";
	return query($query);
}

//============ End of Student Management ============



//========= Materials Management ==================
function addmaterial($data){
	global $conn;

	$materialid = htmlspecialchars($data["materialid"]);
	$class = htmlspecialchars($data["class"]);
	$materialname = htmlspecialchars($data["materialname"]);

	//Upload file material
	$material = uploadmaterial();

	if(!$material) :
		return false;
	endif;

	$namaFile = $_SESSION["material_name"];
	// query insert data
	$query = "INSERT INTO materi
				VALUES
				('$materialid','$class','$materialname','$material','$namaFile')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function uploadmaterial()
{
	$namaFile = $_FILES['materialfile']['name'];
	$ukuranFile = $_FILES['materialfile']['size'];
	$error = $_FILES['materialfile']['error'];
	$tmpName = $_FILES['materialfile']['tmp_name'];

	$_SESSION["material_name"] = $namaFile;

	//Cek apakah tidak ada gambar yang diupload
	if($error === 4) : // error no 4 === tidak ada file yang diupload 
		echo "
			<script>
			 	alert('No file selected');
			</script>
		";
		return false;
	endif;

	// cek apakah yang diupload adalah gambar
	$ekstensiFileValid = ['jpg', 'jpeg', 'png', 'txt', 'docx', 'doc', 'xlsx', 'xls', 'ppt', 'pptx', 'pdf', 'rar', 'zip'];
	$ekstensiFile = explode('.', $namaFile); //explode = pecah string jadi array
	$ekstensiFile = strtolower(end($ekstensiFile)); //strtolower = force huruf besar jadi huruf kecil
	if(!in_array($ekstensiFile, $ekstensiFileValid)) :
		echo "
			<script>
			 	alert('Adding material failed, extension file is not image extension');
			</script>
		";
		return false;
	endif;

	//Cek jika ukurannya terlalu besar
	if($ukuranFile > 30000000) : //Maks = 30 MBytes
		echo "
			<script>
			 	alert('Adding material failed, file size more than 30 MB');
			</script>
		";
		return false;
	endif;

	//lolos pengecekan, file siap diupload
	//generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFile;

	move_uploaded_file($tmpName, 'materials/' . $namaFileBaru);
	return $namaFileBaru;

}

function updatematerial($data){
	global $conn;

	$oldmaterialid = $data["old_id_materi"];
	$materialid = htmlspecialchars($data["materialid"]);
	$class = htmlspecialchars($data["class"]);
	$materialname = htmlspecialchars($data["materialname"]);
	$oldmaterial = htmlspecialchars($data["oldmaterial"]);
	$namaFile = htmlspecialchars($data["file_name"]);

	//Cek apakah user pilih gambar baru atau tidak
	if($_FILES['materialfile']['error'] === 4) :
		$materials = $oldmaterial;
	else :
		$materials = uploadmaterial();
		$namaFile = $_SESSION["material_name"];
	endif;

	// query update data
	$query = "UPDATE materi
				SET
				id_materi = '$materialid',
				id_kelas = '$class',
				nama_materi = '$materialname',
				file_materi = '$materials',
				nama_file = '$namaFile'
			WHERE id_materi = '$oldmaterialid'";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function deletematerial($id_materi){
	global $conn;
	mysqli_query($conn, "DELETE FROM materi WHERE id_materi = '$id_materi'");
	return mysqli_affected_rows($conn);
}

function search_material($keyword){
	$query = "SELECT * FROM materi WHERE 
	id_materi LIKE '%$keyword%' OR 
	id_kelas LIKE '%$keyword%' OR
	nama_materi LIKE '%$keyword%' OR
	nama_file LIKE '%$keyword%'
	";
	return query($query);
}

//========= End of Materials Management ============


//========= Messages Management ================
function search_message($keyword){
	$query = "SELECT * FROM pesan WHERE 
	waktu LIKE '%$keyword%' OR 
	email LIKE '%$keyword%' OR
	pesan LIKE '%$keyword%' OR
	nama LIKE '%$keyword%'
	";
	return query($query);
}

function deletemessage($id_pesan){
	global $conn;
	mysqli_query($conn, "DELETE FROM pesan WHERE id_pesan = '$id_pesan'");
	return mysqli_affected_rows($conn);
}
//========= End of Messages Management ============

//=========== Message from Home ===============

function sendmessage($data){
	global $conn;

	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$pesan = htmlspecialchars($data["pesan"]);

	// query insert data
	$query = "INSERT INTO pesan
				VALUES
				('',CURRENT_TIMESTAMP,'$nama','$email','$pesan')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

//========== End of Message from Home ==========

//========== Register Guest ====================
function register($data){
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$repassword = mysqli_real_escape_string($conn, $data["repassword"]);
	$email = htmlspecialchars($data["email"]);
	$fullname = htmlspecialchars($data["name"]);

	// cek username sudah atau belum
	$result = mysqli_query($conn, "SELECT username FROM login WHERE username = '$username'");
	if(mysqli_fetch_assoc($result)) :
		echo "<script> 
			alert('Username sudah terdaftar!')
		</script>";
		return false;
	endif;

	//cek konfirmasi password
	if($password !== $repassword) :
		echo "<script>
			alert('Konfirmasi password tidak sesuai!');
		</script>";
		return false;
	endif;

	// enkripsi password, terdapat password_hash dan md5, jangan gunakan md5 karna string nya bisa diconvert di google
	// $password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO login VALUES('$username','$password','$fullname','$email','Guest')");
	return mysqli_affected_rows($conn);
}
//========== End of Register Guest ==============




?>