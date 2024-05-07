<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display: grid;
            justify-content: center;
            background-color: lightblue;
        }
        .Box{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="Box">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        class Sheell {
            public $jumlah;
            public $jenis; 
            public $ppn;
            public $data_harga = [
                "S Super" => 15420,
                "S V-Power" => 16130,
                "S V-Power Diesel" => 18310,
                "S V-Power Nitro" => 16510
            ];

            public function __construct($jumlah,$jenis,$ppn) {
                $this->jumlah = $jumlah;
                $this->jenis = $jenis;
                $this->ppn = $ppn;
            }

            public function getJumlah() {
                return $this->jumlah; 
            }

            public function getJenis() {
                return $this->jenis; 
            }

        }
        
        //membuat class beli yang mewarisi kelas sheell
        class Beli extends Sheell {
            public function getTotal() {
                return $this->jumlah * $this->data_harga[$this->jenis] * (1 + $this->ppn);
            }

        }
        //membuat objek dari kelas sheell dengan mengirimkan data yang diinput oleh user
        $Beli = new Beli($_POST['jumlah'],$_POST['jenis'], $_POST['ppn']);

        $total = $Beli->getTotal();
        echo "------------------------------------------------------------------<br>";
        echo "Anda membeli bahan bakar minyak tipe ".$Beli->getJenis(). "<br>" ;
        echo "Dengan jumlah : ". $Beli->getJumlah() ." Liter <br>";
        echo "Total yang harus anda bayar Rp. ". number_format($total,0,',','.') . "<br>";
        echo "------------------------------------------------------------------<br>";
    }
    ?>
    </div> 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Masukkan Jumlah Liter : <input type="number" name="jumlah"><br> 
    Pilih Tipe Bahan Bakar :
        <select name="jenis">
            <option value="S Super">Shell Super</option>
            <option value="S V-Power">Shell V-Power</option>
            <option value="S V-Power Diesel">Shell V-Power Diesel</option>
            <option value="S V-Power Nitro">Shell V-Power Nitro</option>
        </select><br>
        <input type="submit" value="Beli">
        <input type="hidden" name="ppn" value="0.10">
    </form>
</body>
</html>
