<!DOCTYPE html>
<html>

<head>
    <title>Title of the document</title>
</head>

<body>

    <?php
    $curl = curl_init();
    $url = "https://recruitment.fastprint.co.id/tes/api_tes_programmer";
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);

    $data = array(
        'username' => 'tesprogrammer100623C11',
        'password' => md5('bisacoding-10-06-23'),
    );
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //execute request
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //$response = curl_exec($curl);
    $response = json_decode(curl_exec($curl));

    //function create or update
    foreach ($response as $id_produk) {
        $flight = flight::updateorCreate(
            ['id' => $id_produk->id],
            ['name' => $nama_produk->name],
            ['category' => $kategori->category],
            ['price' => $harga->price],
            ['status' => $status->status]
        );
    }

    //get default reponse
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin:');

    //close connection
    curl_close($curl);
    flush();


    ?>
</body>

</html>