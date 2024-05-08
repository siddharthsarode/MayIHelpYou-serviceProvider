<?php

$server_name = "localhost";
$user = "root";
$password = "";
$database_name = "mayihelpyou";
$port_name = 3306;

$conn = new mysqli($server_name, $user, $password, $database_name, $port_name);

if ($conn->connect_error) {
    echo "<script>alert('Database cannot Connected')</script>";
    header("location: index.php");
}

//class for uploading document file to the new folder
class FileUpload
{
    private $fileArray, $file, $fileExt, $fileName, $format, $imageFile, $path, $upload, $temp, $result;
    public function __construct($fileArray, $format, $storagePath, $uploadPath)
    {
        $this->fileArray = $fileArray;
        $this->format = $format;
        $this->path = $storagePath;
        $this->upload = $uploadPath;
    }
    public function upload()
    {
        $this->file = $this->fileArray['name'];
        $this->fileExt = pathinfo($this->file, PATHINFO_EXTENSION);
        $this->fileName = pathinfo($this->file, PATHINFO_FILENAME);
        $this->imageFile = $this->fileName . "_" . $this->format . "." . $this->fileExt;
        $this->path = $this->path . $this->imageFile;
        $this->upload = $this->upload . $this->imageFile;
        $this->temp = $this->fileArray['tmp_name'];
        $this->result = move_uploaded_file($this->temp, $this->upload);
    }
    public function getResult()
    {
        return $this->result;
    }
    public function getStoragePath()
    {
        return $this->path;
    }
    public function getUploadPath()
    {
        return $this->upload;
    }
}
// Function definition
function userExist($email)
{
    global $conn;
    $sql = $conn->prepare("SELECT * FROM `user` WHERE `user_email` = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();
    return ($result->num_rows == 1) ? 1 : 0;
}

function empExist($email)
{
    global $conn;
    $sql = $conn->prepare("SELECT * FROM `employee` WHERE `emp_email` = ?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();
    return ($result->num_rows == 1) ? 1 : 0;
}

function adminExist($email)
{
    global $conn;
    $sql = $conn->prepare("SELECT * FROM `admin` WHERE `admin_email`=?");
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();
    return ($result->num_rows == 1) ? 1 : 0;
}