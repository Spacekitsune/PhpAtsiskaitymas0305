<?php

//tikrinam ar vartotojas šitą failą pasiekė per signup mygtuką signup.php faile. Taip apsisaugom, kad failas nebūtų pasiekiamas tiesiogiai per URL.
if (isset($_POST['signup-submit'])) {
    // tik tokiu atveju leidžia pereiti prie prisijungimo prie db.
    require 'dbh.inc.php';

    //vartotojo įvestą informaciją verčiam į kintamuosius.
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    //tikrinam vartotojo galimai įvestas klaidas.

    //ar nėra palikta neužpildytų laukų.
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
      // klaidos žinutė
      //& dalis suteikia galimybę palikti tas pačias vertes, jei jos buvo įrašytos.
      //šitos vertės matomos URL, todėl negalima palikti galimybės išlaikyti slaptažodžio
      //slaptažodis visada turi būti vedamas iš naujo.
      header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
      //jei atitinka sąlygą - nutraukia procesą (break'as)
      exit();
    }
    //sąlyga tikrina ar tinkamas epaštas ir vartotojo vardas
    //apačioj dvi salygos padalintos atskirai
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../signup.php?error=invalidmailuid");
      exit();
    }
    //sąlyga su metodu, tikrinanti ar email'as yra tinkamas
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../signup.php?error=invalidmail&uid=".$username);
      exit();
    }
    // sąlyga su metodu tikrina ar vedami tik leidžiami ženklai
    // tikriną kas yra leidžiama paieškoje (search pattern)
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../signup.php?error=invaliduid&mail=".$email);
      exit();
    }
    //sąlyga tikrina ar abu įvesti slaptažodžiai yra vienodi
    else if($password !== $passwordRepeat) {
      header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
      exit();
    }
    //sąlyga tikrina ar db jau neegzistuoja toks vartotojas
    else {

      //kuriam kintamąjį, kuris tikriną db users lentelę.
      // saugumo sumetimais nerašom WHERE uidUsers=$username
      // kad nebūtų pažeista db rašant sql kodą tiesiai į input lauką formoje
      //prepared statements & placeholders (klaustukas žemiau)
      $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
      //ar viršuj nurodyta paieška veikia su žemiau nurodytu prisijungimu prie db (kintamasis iš dbh.inc.php)
        $stmt = mysqli_stmt_init($conn);
      //pirmiausia tikrinam ar pavyksta prisijungti ir ar veikia sql užklausa
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
      }
      //jei veikia tada pateikiam reikšmes
      //s reiškia string (b-bolean, i-integer) kiekis toks, kiek sql užklausoje buvo klaustukų.
      else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        //metodas, kuris paleidžia sql kodą (run sql)
        mysqli_stmt_execute($stmt);
        //iš db gautą atsakymą perrašom kaip vertę kintamajam $stmt
        mysqli_stmt_store_result($stmt);
        //kuriamas kintamasis lygus metodui, kuris parodo kiek eilučių yra grąžinama iš sql paieškos
        //pvz jeigu jau yra toks vartotojas, tai bus grąžinama viena eilutė.
        $resultCheck =mysqli_stmt_num_rows($stmt);
          if ($resultCheck > 0) {
            header("Location: ../signup.php?error=usertaken.&mail=".$email);
            exit();
          }
          else {
            //ir jeigu viskas gerai, siunčiama sql užklausa naujo vartotojo db'e sukurimui
            //vietoj kintamųjų naudojami klaustukai (placeholder), kad tiesiogiai nebūtų kopijuojami vartotojo pateikti duomenys.
            $sql ="INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("Location: ../signup.php?error=sqlerror");
              exit();
            }
            else {
              // slaptažodžio hash'imas
              $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

              mysqli_stmt_bind_param($stmt, "sss", $username,$email,$hashedPwd );
              mysqli_stmt_execute($stmt);
              //prisijungimas sėkmingas žinutė
              header("Location: ../signup.php?signup=success");
              exit();
            }
          }
      }
  }
  //uždaromas sujungimas su db
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  //jeigu vartotojas atsidurė kažkokiu budu signup.inc.php faile ne per signup mygtuką
  //sąlyga nusiunčia atgal į signup.php failą
  header("Location: ../signup.php");
  exit();
}
