<?php

// Tạo hàm kết nối với database bằng thư viện PDO

// function_exists() => Kiểm tra 1 hàm đã tồn tại hay chưa
// Tồn tại => true <=> false
// Tên hàm dưới dạng 1 chuỗi
if(!function_exists('getConnection')){
	function getConnection()
	{
		$username = "root";
		$password = "root";
		$db_url = "mysql:host=localhost; dbname=hoaqua";
		$conn = new PDO($db_url, $username, $password);

		try {
			return  $conn;
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		return false;
	}
}


// Thực thi câu lệnh (SELECT) lấy tất cả các các bản ghi

if(!function_exists('get_all_data')){
	function get_all_data($sql) {
		$list_array = array_slice(func_get_args(),1);
		try {
			$conn = getConnection();
			$stmt = $conn->prepare($sql);
			$stmt->execute($list_array);
			$values = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $values;
		}
		catch (PDOException $e) {
			throw $e->getMessage();
		}
	   
	}
}

// Thực thi câu lệnh (SELECT) lấy 1 các các bản ghi

if(!function_exists('get_one_data')){
	function get_one_data($sql) {
		$list_array = array_slice(func_get_args(),1);
		try {
			$conn = getConnection();
			$stmt = $conn->prepare($sql);
			$stmt->execute($list_array);
			$value = $stmt->fetch(PDO::FETCH_ASSOC);
			return $value;
		}
		catch (PDOException $e) {
			throw $e;
		}
		finally {
			unset($conn);
		}
	}
}

// Thực thi câu lệnh DELETE database 

if(!function_exists('delete')){
	function delete($table, $where = '') {
		$connect = getConnection();
		try{
			if(!empty($table) && !empty($where)){
				$sql = "DELETE FROM $table WHERE $where";
				$stmt = $connect->prepare($sql);
				$stmt->execute();
			}
			return true;
		}catch(\Exception $e){
			throw new Exception($e->getMessage());
		}
		return true;
	}
}

// Thực thi câu lệnh INSERT database 

if(!function_exists('insert')){
	function insert($table, $data){
		$connect = getConnection();
		/* $data = [
			'name' => 'khanh',
			'old' => '23',
			'address' => 'Nghe an'
		]
		*/
		if(!empty($table) && !empty($data)){
			$field = '';
			$valueInsert = '';
			foreach($data as $fieldName => $value){
				// Nối chuỗi
				$field .= $fieldName. ',';
				$valueInsert .= "'".$value."'". ',';
			}
			$field = rtrim($field,',');
			$valueInsert = rtrim($valueInsert,',');
			$sql = "INSERT INTO $table ($field ) VALUES ($valueInsert)";
			try{
				$stmt = $connect->prepare($sql);
				return $stmt->execute();
			}catch(\Exception $e){
				throw new Exception($e->getMessage());
			}
		}
		return false;
	}
}


if(!function_exists('getTitle')){
	function getTitle($fileName){
		// explode() trả về 1 chuỗi các phần tử của 1 mảng
		/* VD: $fileName = product.php
						(
							[0] => product
							[1] => php
						)
		*/ 
		$file = explode('.', $fileName);
		$fileName = $file[0] ?? 'index';
		// $fileName => product
		$title = 'Trang chủ';
		switch ($fileName){
			case 'index':
				$title = 'Trang chủ';
				break;
			case 'news':
				$title = 'Tin tức';
				break;
			case 'product':
				$title = 'Sản phẩm';
				break;
			case 'contact':
				$title = 'Liên hệ';
				break;
			case 'cart':
				$title = 'Giỏ hàng';
				break;
			case 'payment':
				$title = 'Thanh toán';
				break;
			case 'detail':
				$title = 'Chi tiết sản phẩm';
				break;
			default:
				$title = ucfirst($fileName);
				break;
		}
		return $title;
	}
}


