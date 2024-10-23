<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanggar Tari Bandung - Pilih Kelas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <?php
    function determineClass($age, $gender) {
        if ($gender == 'male') {
            if ($age >= 5 && $age <= 10) {
                return "Kelas Anak-anak";
            } elseif ($age >= 11 && $age <= 17) {
                return "Kelas Remaja";
            } elseif ($age >= 18) {
                return "Kelas Dewasa";
            } else {
                return "Maaf, usia terlalu muda untuk mengikuti kelas";
            }
        } elseif ($gender == 'female') {
            if ($age >= 6 && $age <= 11) {
                return "Kelas Anak-anak";
            } elseif ($age >= 12 && $age <= 20) {
                return "Kelas Remaja";
            } elseif ($age >= 21) {
                return "Kelas Dewasa";
            } else {
                return "Maaf, usia terlalu muda untuk mengikuti kelas";
            }
        } else {
            return "Silakan pilih jenis kelamin";
        }
    }

    $message = '';
    $messageClass = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['age']) && isset($_POST['gender'])) {
            $age = intval($_POST['age']);
            $gender = $_POST['gender'];
            
            if ($age <= 0) {
                $message = "Mohon masukkan usia yang valid";
                $messageClass = "alert-danger";
            } elseif ($gender == "") {
                $message = "Mohon pilih jenis kelamin";
                $messageClass = "alert-danger";
            } else {
                $result = determineClass($age, $gender);
                $message = "Berdasarkan usia " . $age . " tahun dan jenis kelamin " . 
                          ($gender == 'male' ? 'Laki-laki' : 'Perempuan') . 
                          ", Anda masuk dalam: " . $result;
                $messageClass = "alert-success";
            }
        }
    }
    ?>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Sistem Pemilihan Kelas Tari</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        Masukkan Usia Anda
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="age" class="form-label">Usia</label>
                                <input type="number" class="form-control" id="age" name="age" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="male">Laki-laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cek Kelas</button>
                        </form>
                        <?php if ($message): ?>
                        <div class="mt-3">
                            <div class="alert <?php echo $messageClass; ?>" role="alert">
                                <?php echo $message; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>