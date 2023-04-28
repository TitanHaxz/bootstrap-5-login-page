<?php
	session_start();
	require_once('database.php');

	// Eğer kullanıcı giriş yaptıysa, index.php sayfasına yönlendirilir.
	if (isset($_SESSION['loggedin'])) {
		header('Location: index.php');
		exit();
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if($data = $conn -> prepare('SELECT id, name, password FROM users WHERE email = ?')){
			$data -> bind_param('s', $_POST['email']);
			$data -> execute();
			$data -> store_result();

			if ($data -> num_rows > 0){
				$data -> bind_result($id, $name, $password);
				$data -> fetch();
			
				if(password_verify($_POST['password'], $password)){
					session_regenerate_id();
					$_SESSION['loggedin'] = TRUE;
					$_SESSION['name'] = $name;
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['id'] = $id;
			
					session_start();
					header('Location: index.php');
					exit();
				}
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Bootstrap 5 Login Page</title>
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
							<h1 class="fs-4 card-title fw-bold mb-4">Giriş Yap</h1>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Adresi</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email geçersiz!
									</div>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Şifre</label>
										<a href="forgot.php" class="float-end">
											Şifreni mi unuttun?
										</a>
									</div>
									<input id="password" type="password" class="form-control" name="password" required>
								    <div class="invalid-feedback">
								    	Password gerekli!
							    	</div>
								</div>

								<div class="d-flex align-items-center">
									<div class="form-check">
										<input type="checkbox" name="remember" id="remember" class="form-check-input">
										<label for="remember" class="form-check-label">Beni hatırla!</label>
									</div>
									<button type="submit" class="btn btn-primary ms-auto">
										Giriş yap
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Hesabın yok mu? <a href="register.php" class="text-dark">Kayıt ol!</a>
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
