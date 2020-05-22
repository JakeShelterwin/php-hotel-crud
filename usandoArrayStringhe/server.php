<?php
  //Obiettivo: produrre una lista in HTML con stato e prezzo di tutti i pagamenti

  header('Content-Type: application/json');

  //salvo in variabili i dati da passare a mysqli per la connessione al database
  $server = 'localhost';
  $username = 'root';
  $password = 'root';
  $dbName = 'HotelDB';

  //uso l'oggetto $mysqli con i dati di connessione per connettermi
  $conn = new mysqli($server, $username, $password, $dbName);

  //controllo di non aver fatto errori nel prendere dati
  if ($conn -> connect_errno){
    echo $conn -> connect_errno;
    return;

  }

  //scrivo la query da passare al database
  $sql = "
          SELECT status, price
          FROM pagamenti
  ";

  //la passo al database e la salvo nella variabile results.
  $results = $conn -> query($sql);

  //controllo che i risultati esistano (qundi che le rows resituite non siano <1)
  if ($results -> num_rows < 1){

    echo 'no results';
    return;
  }

  //per ogni riga di results stampo nome cognome address
  $res = [];
  while ($row = $results -> fetch_assoc()){

    $res[] = $row['status']. " "
            .$row['price'].'<br>';
    // $res[] = $row;
    // se facessi $res[] = $row; va bene lo stesso, viene un array associativo composto
    //da nomeColonnaDelDatabase => e l'equivalente valore esempio:
    // status => accepted
    // price => 999
    // crearsi l'array $res[] è necessario per salvare ogni row (quindi non posso mettere $row nel json encode), perché il while asfalta via via la row precedente con quella successiva (e alla fine restituirebbe NULL perché si blocca quando finiscono le row, quindi l'ultima row è NULL/vuota).
  }

  $conn -> close();
  echo json_encode($res);
 ?>
