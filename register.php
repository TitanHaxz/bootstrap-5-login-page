<?php 
	require_once('database.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if ($data = $conn -> prepare('SELECT id, name, email, password FROM users WHERE id = ?')) {
			$data -> bind_param('s', $_POST['name']);
			$data -> execute();
			$data -> store_result();

			// Kayıt formunda istenilenler eksiksiz ve doğruysa database ile bağlantı kurulur
			// Kullanıcının doldurduğu form bilgileri database işlenir

			if($data = $conn -> prepare('INSERT INTO users (name, email, password) VALUES (?,?,?)')){
				// ⁡⁢⁣⁣Kullanıcının şifresini güvenli bir şekilde saklamak için hash fonksiyonu kullanıyoruz⁡
				$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

				$data -> bind_param('sss', $_POST['name'], $_POST['email'], $pass);
				$data -> execute();

				// Kayıt işlemi başarıyla sonuçlaırsa kullanıcıyı `index.php` sayfasına aktarır.
				header('Location: index.php');
				exit();
			// Sorgu sırasında herhagi bir hata ile karşılaşılırsa
			}else {
				echo "Veritabanı sorgusu hazırlanırken bir hata oluştu: ";
			}
		
		}
		// conn işlemi sonlandırılır.
		$conn -> close();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Bootstrap 5 Register Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Kayıt Oluştur</h1>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="name">İsim</label>
									<input id="name" type="text" class="form-control" name="name" value="" required>
									<div class="invalid-feedback">
										İsim gerekli!
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Adresi</label>
									<input id="email" type="email" class="form-control" name="email" value="" required>
									<div class="invalid-feedback">
										Email geçersiz!
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Şifre</label>
									<input id="password" type="password" class="form-control" name="password" required>
								    <div class="invalid-feedback">
								    	Şifre gerekli!
							    	</div>
								</div>

								<p class="form-text text-muted mb-3">
								Kaydolarak şartlarımızı ve koşullarımızı kabul etmiş olursunuz.
								</p>

								<div class="align-items-center d-flex">
									<button type="submit" class="btn btn-primary ms-auto">
										Oluştur	
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Zaten bir hesabın var mı? <a href="login.php" class="text-dark">Giriş yap!</a>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; 2017-2021 &mdash; Your Company 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/login.js"></script>
</body>
</html>
